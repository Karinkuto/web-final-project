<?php

namespace App\Controllers;

use App\Core\Controller;

class AdminController extends Controller
{
    private function requireAdmin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['is_admin'])) {
            header('Location: /login');
            exit;
        }
    }

    public function dashboard()
    {
        $this->requireAdmin();
        echo $this->view('admin/dashboard', [
            'title' => 'Admin Dashboard'
        ]);
    }

    public function productList()
    {
        $this->requireAdmin();
        $products = (new \App\Controllers\ProductController())->products ?? [];
        echo $this->view('admin/product_list', [
            'title' => 'Manage Products',
            'products' => $products
        ]);
    }

    public function addProduct()
    {
        $this->requireAdmin();
        echo $this->view('admin/add_product', [
            'title' => 'Add Product'
        ]);
    }

    public function editProduct($id)
    {
        $this->requireAdmin();
        // For demo, get product from ProductController
        $productController = new \App\Controllers\ProductController();
        $products = $productController->products ?? [];
        $product = null;
        foreach ($products as $p) {
            if ($p['id'] == $id) {
                $product = $p;
                break;
            }
        }
        if (!$product) {
            http_response_code(404);
            echo $this->view('errors/404', ['title' => 'Product Not Found']);
            return;
        }
        // Handle POST (update)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // In a real app, update the product in DB or file
            // For now, just redirect back to product list
            header('Location: /admin/products');
            exit;
        }
        echo $this->view('admin/edit_product', [
            'title' => 'Edit Product',
            'product' => $product
        ]);
    }

    public function deleteProduct($id)
    {
        $this->requireAdmin();
        // In a real app, delete the product from DB or file
        // For now, just redirect back to product list
        header('Location: /admin/products');
        exit;
    }
}