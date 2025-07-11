<?php

// Create a new Router instance
$router = new App\Core\Router();

// Define routes
$router->get('/', 'HomeController@index');
$router->get('/home', 'HomeController@index');
$router->get('/products', 'ProductController@index');
$router->get('/products/{:id}', 'ProductController@show');
$router->get('/cart', 'CartController@index');
$router->get('/login', 'LoginController@showLoginForm');
$router->post('/login', 'LoginController@showLoginForm');
$router->get('/logout', 'LoginController@logout');
$router->get('/admin', 'AdminController@dashboard');
$router->get('/admin/products', 'AdminController@productList');
$router->get('/admin/products/add', 'AdminController@addProduct');
$router->get('/admin/products/edit/{:id}', 'AdminController@editProduct');
$router->post('/admin/products/edit/{:id}', 'AdminController@editProduct');
$router->post('/admin/products/delete/{:id}', 'AdminController@deleteProduct');

// 404 Not Found handler
$router->setNotFoundHandler('HomeController@notFound');

// Return the router instance
return $router;
