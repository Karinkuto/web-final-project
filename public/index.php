<?php
/**
 * Front controller for the application
 */

// Define the base path
$basePath = dirname(__DIR__);

// Require the autoloader
require $basePath . '/vendor/autoload.php';

// Require the routes file
require $basePath . '/app/routes.php';

// Get the current URL path
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Match the route
$router->dispatch($requestMethod, $requestUri);
