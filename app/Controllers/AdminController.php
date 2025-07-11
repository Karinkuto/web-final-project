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
        // Basic fields
        $data = [
            'name' => $_POST['name'] ?? '',
            'brand' => $_POST['brand'] ?? '',
            'price' => (float)($_POST['price'] ?? 0),
            'original_price' => !empty($_POST['original_price']) ? (float)$_POST['original_price'] : null,
            'description' => $_POST['description'] ?? '',
            'category' => $_POST['category'] ?? 'Uncategorized',
            'sku' => $_POST['sku'] ?? '',
            'in_stock' => isset($_POST['in_stock']) ? 1 : 0,
            'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
            'is_new' => isset($_POST['is_new']) ? 1 : 0,
            'rating' => !empty($_POST['rating']) ? (float)$_POST['rating'] : 0,
            'review_count' => !empty($_POST['review_count']) ? (int)$_POST['review_count'] : 0,
        ];
        
        // Handle file uploads for main image
        if (!empty($_FILES['image']['name'])) {
            $uploadResult = $this->handleFileUpload('image');
            if ($uploadResult['success']) {
                $data['image'] = $uploadResult['path'];
            } else {
                $_SESSION['error'] = $uploadResult['error'];
            }
        }
        
        // Handle multiple images
        if (!empty($_FILES['images']['name'][0])) {
            $uploadedImages = [];
            $fileCount = count($_FILES['images']['name']);
            
            for ($i = 0; $i < $fileCount; $i++) {
                if ($_FILES['images']['error'][$i] === UPLOAD_ERR_OK) {
                    $file = [
                        'name' => $_FILES['images']['name'][$i],
                        'type' => $_FILES['images']['type'][$i],
                        'tmp_name' => $_FILES['images']['tmp_name'][$i],
                        'error' => $_FILES['images']['error'][$i],
                        'size' => $_FILES['images']['size'][$i]
                    ];
                    
                    $uploadResult = $this->handleFileUpload($file, true);
                    if ($uploadResult['success']) {
                        $uploadedImages[] = $uploadResult['path'];
                    }
                }
            }
            
            if (!empty($uploadedImages)) {
                $data['images'] = json_encode($uploadedImages);
            }
        }
        
        // Handle JSON fields
        $jsonFields = ['features', 'dimensions', 'materials', 'colors', 'care_instructions'];
        foreach ($jsonFields as $field) {
            if (!empty($_POST[$field])) {
                if (is_array($_POST[$field])) {
                    $data[$field] = json_encode($_POST[$field]);
                } elseif (is_string($_POST[$field])) {
                    $data[$field] = $_POST[$field]; // Already JSON encoded
                }
            }
        }
        
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