<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        echo $this->view('home', [
            'title' => 'Welcome to Our Website',
            'content' => 'Hello from the HomeController!'
        ]);
    }
    
    public function notFound()
    {
        http_response_code(404);
        echo $this->view('errors/404', [
            'title' => '404 - Page Not Found',
            'message' => 'The page you are looking for does not exist.'
        ]);
    }
}
