<?php

// Create a new Router instance
$router = new App\Core\Router();

// Define routes
$router->get('/', 'LoginController@showLoginForm');
$router->get('/home', 'HomeController@index');
$router->get('/products', 'ProductController@index');
$router->get('/products/{:id}', 'ProductController@show');
$router->get('/cart', 'CartController@index');
$router->get('/login', 'LoginController@showLoginForm');
$router->post('/login', 'LoginController@showLoginForm');

// 404 Not Found handler
$router->setNotFoundHandler('HomeController@notFound');

// Return the router instance
return $router;
