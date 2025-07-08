<?php

namespace App\Core;

class Controller
{
    protected function view($view, $data = [])
    {
        // Extract data to variables
        extract($data);
        
        // Start output buffering
        ob_start();
        
        // Include the view file
        $viewFile = dirname(__DIR__) . "/views/{$view}.php";
        
        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            throw new \Exception("View file {$viewFile} not found");
        }
        
        // Get the contents of the buffer and clean it
        return ob_get_clean();
    }
    
    protected function json($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
