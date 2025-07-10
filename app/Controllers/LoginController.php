<?php

namespace App\Controllers;

use App\Core\Controller;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            // Placeholder: Accept only a specific email/password for demo
            if ($email === 'admin@example.com' && $password === 'pass145&22') {
                header('Location: /home');
                exit;
            } else {
                $error = 'Invalid email or password.';
            }
        }
        echo $this->view('login', [
            'title' => 'Login',
            'error' => $error
        ]);
    }
} 