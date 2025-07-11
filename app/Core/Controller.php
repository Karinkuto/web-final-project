<?php

namespace App\Core;

class Controller
{
    protected function view($view, $data = [])
    {
        // Extract data to variables
        extract($data);
        
        // Include the layout file which will include the view
        $layoutFile = dirname(__DIR__) . "/views/layouts/app.php";
        $viewFile = dirname(__DIR__) . "/views/{$view}.php";
        
        if (!file_exists($viewFile)) {
            throw new \Exception("View file {$viewFile} not found");
        }
        
        // Start output buffering for the view content
        ob_start();
        include $viewFile;
        $content = ob_get_clean();
        
        // Include the layout with the content
        include $layoutFile;
    }
    
    protected function json($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
