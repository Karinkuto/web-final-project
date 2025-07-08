<?php

namespace App\Core;

class Router
{
    protected $routes = [];
    protected $notFoundHandler;

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
            // Convert route path to regex
            $pattern = '#^' . preg_replace('/\//', '\/', $route['path']) . '$#';
            
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
        list($controller, $method) = explode('@', $handler);
        $controller = "App\\Controllers\\$controller";
        
        if (class_exists($controller)) {
            $controllerInstance = new $controller();
            
            if (method_exists($controllerInstance, $method)) {
                call_user_func_array([$controllerInstance, $method], $params);
                return;
            }
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
