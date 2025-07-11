<?php

namespace App\Core;

class Router
{
    protected $routes = [];
    protected $notFoundHandler;
    protected $container;

    public function __construct()
    {
        $this->container = new \stdClass();
        $this->setupContainer();
    }

    protected function setupContainer()
    {
        // Set up the database connection
        $db = Database::getInstance();
        $pdo = $db->getConnection();
        
        // Register models
        $this->container->productModel = function() use ($pdo) {
            return new \App\Models\Product($pdo);
        };
        
        // Register controllers with their dependencies
        $this->container->productController = function() use ($pdo) {
            $productModel = $this->container->productModel->__invoke();
            return new \App\Controllers\ProductController($productModel);
        };
        
        $this->container->adminController = function() use ($pdo) {
            $productModel = $this->container->productModel->__invoke();
            return new \App\Controllers\AdminController($productModel);
        };
    }

    public function addRoute($method, $path, $handler)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function get($path, $handler)
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post($path, $handler)
    {
        $this->addRoute('POST', $path, $handler);
    }

    public function setNotFoundHandler($handler)
    {
        $this->notFoundHandler = $handler;
    }

    public function dispatch($method, $uri)
    {
        // Remove query string
        $uri = strtok($uri, '?');
        
        // Remove trailing slash
        $uri = rtrim($uri, '/');
        $uri = $uri === '' ? '/' : $uri;

        foreach ($this->routes as $route) {
            // Convert route path to regex, handling parameters like {id}
            $pattern = $route['path'];
            $pattern = preg_replace('/\//', '\/', $pattern); // Escape forward slashes
            $pattern = preg_replace('/\{:([a-zA-Z]+)\}/', '([^\/]+)', $pattern); // Replace {param} with regex group
            $pattern = '#^' . $pattern . '$#';
            
            if ($route['method'] === $method && preg_match($pattern, $uri, $matches)) {
                // Remove the full match from matches
                array_shift($matches);
                
                // Call the handler with matched parameters
                if (is_callable($route['handler'])) {
                    call_user_func_array($route['handler'], $matches);
                    return;
                } elseif (is_string($route['handler'])) {
                    $this->callControllerAction($route['handler'], $matches);
                    return;
                }
            }
        }

        // No route matched
        $this->handleNotFound();
    }

    protected function callControllerAction($handler, $params = [])
    {
        list($controllerName, $method) = explode('@', $handler);
        $controllerKey = lcfirst(str_replace('Controller', '', $controllerName));
        
        // Always try to get controller from container first
        if (isset($this->container->$controllerKey) && is_callable($this->container->$controllerKey)) {
            $controllerInstance = $this->container->$controllerKey->__invoke();
        } else {
            // If not in container, try to create with default dependencies
            $controllerClass = "App\\Controllers\\$controllerName";
            if (!class_exists($controllerClass)) {
                $this->handleNotFound();
                return;
            }
            
            // Special handling for controllers with dependencies
            switch ($controllerName) {
                case 'ProductController':
                case 'AdminController':
                    $productModel = new \App\Models\Product();
                    $controllerInstance = new $controllerClass($productModel);
                    break;
                default:
                    $controllerInstance = new $controllerClass();
            }
        }
        
        if (method_exists($controllerInstance, $method)) {
            call_user_func_array([$controllerInstance, $method], $params);
            return;
        }
        
        $this->handleNotFound();
    }

    protected function handleNotFound()
    {
        if ($this->notFoundHandler) {
            if (is_callable($this->notFoundHandler)) {
                call_user_func($this->notFoundHandler);
                return;
            } elseif (is_string($this->notFoundHandler)) {
                $this->callControllerAction($this->notFoundHandler);
                return;
            }
        }
        
        // Default 404 response
        header("HTTP/1.0 404 Not Found");
        echo '404 - Page not found';
    }
}
