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
            $validAdmins = [
                ['email' => 'admin@example.com', 'password' => 'pass145&22'],
                ['email' => 'admin2@example.com', 'password' => 'secret123'],
            ];
            $isValid = false;
            foreach ($validAdmins as $admin) {
                if ($email === $admin['email'] && $password === $admin['password']) {
                    $isValid = true;
                    break;
                }
            }
            if ($isValid) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['is_admin'] = true;
                header('Location: /admin');
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

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header('Location: /login');
        exit;
    }
} 