<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product as ProductModel;

class AdminController extends Controller
{
    protected $productModel;

    /**
     * @param ProductModel $productModel
     */
    public function __construct(ProductModel $productModel)
    {
        $this->productModel = $productModel;
        $this->requireAdmin();
    }

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
        // Get all products for the dashboard
        $products = array_map(
            [$this->productModel, 'formatProduct'],
            $this->productModel->getFeatured(6) // Show 6 featured products
        );

        $data = [
            'title' => 'Admin Dashboard',
            'products' => $products
        ];

        $this->view('admin/dashboard', $data);
    }

    public function productList()
    {
        $products = array_map(
            [$this->productModel, 'formatProduct'],
            $this->productModel->all()
        );

        $data = [
            'title' => 'Manage Products',
            'products' => $products
        ];

        $this->view('admin/product_list', $data);
    }

    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process form submission
            $data = $this->getProductDataFromPost();

            // Validate data (you should add more validation)
            if (empty($data['name']) || empty($data['price'])) {
                $_SESSION['error'] = 'Name and price are required';
                $this->view('admin/add_product', [
                    'title' => 'Add Product',
                    'product' => $data
                ]);
                return;
            }

            // Create the product
            if ($this->productModel->create($data)) {
                $_SESSION['success'] = 'Product added successfully';
                header('Location: /admin/products');
                exit;
            } else {
                $_SESSION['error'] = 'Failed to add product';
            }
        }

        $this->view('admin/add_product', [
            'title' => 'Add Product',
            'product' => []
        ]);
    }

    public function editProduct($id)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            $this->notFound();
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process form submission
            $data = $this->getProductDataFromPost();

            // Validate data (you should add more validation)
            if (empty($data['name']) || empty($data['price'])) {
                $_SESSION['error'] = 'Name and price are required';
                $this->view('admin/edit_product', [
                    'title' => 'Edit Product',
                    'product' => array_merge($product, $data)
                ]);
                return;
            }

            // Update the product
            if ($this->productModel->update($id, $data)) {
                $_SESSION['success'] = 'Product updated successfully';
                header('Location: /admin/products');
                exit;
            } else {
                $_SESSION['error'] = 'Failed to update product';
            }
        }

        // Format product for the view
        $formattedProduct = $this->productModel->formatProduct($product);

        $this->view('admin/edit_product', [
            'title' => 'Edit Product',
            'product' => $formattedProduct
        ]);
    }

    public function deleteProduct($id)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            $this->notFound();
            return;
        }

        if ($this->productModel->delete($id)) {
            $_SESSION['success'] = 'Product deleted successfully';
        } else {
            $_SESSION['error'] = 'Failed to delete product';
        }

        header('Location: /admin/products');
        exit;
    }

    /**
     * Helper method to extract product data from POST request
     */
    private function getProductDataFromPost()
    {
        // Only include fields present in the add/edit product forms
        $data = [
            'name' => $_POST['name'] ?? '',
            'price' => (float)($_POST['price'] ?? 0),
            'category' => $_POST['category'] ?? '',
            'image_url' => $_POST['image'] ?? '',
            'description' => $_POST['description'] ?? '',
        ];
        return $data;
    }

    /**
     * Handle file uploads
     */
    private function handleFileUpload($file, $isMultiple = false)
    {
        $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/products/';

        // Create uploads directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        if ($isMultiple) {
            // Handle multiple file upload
            $fileName = time() . '_' . basename($file['name']);
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                return [
                    'success' => true,
                    'path' => '/uploads/products/' . $fileName
                ];
            }
        } else {
            // Handle single file upload
            $fileName = time() . '_' . basename($_FILES[$file]['name']);
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES[$file]['tmp_name'], $targetFile)) {
                return [
                    'success' => true,
                    'path' => '/uploads/products/' . $fileName
                ];
            }
        }

        return [
            'success' => false,
            'error' => 'Failed to upload file'
        ];
    }

    /**
     * Show 404 page
     */
    private function notFound()
    {
        http_response_code(404);
        $this->view('errors/404', ['title' => 'Not Found']);
    }
}
