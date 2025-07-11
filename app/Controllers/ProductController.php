<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product as ProductModel;

class ProductController extends Controller
{
    protected $productModel;

    /**
     * @param ProductModel $productModel
     */
    public function __construct(ProductModel $productModel)
    {
        $this->productModel = $productModel;
    }

    /**
     * Get all products (for backward compatibility)
     * 
     * @return array
     */
    public function getProducts()
    {
        // This is kept for backward compatibility
        // In a real app, you might want to update code to use the model directly
        return array_map([$this->productModel, 'formatProduct'], $this->productModel->all());
    }

    public function index()
    {
        // Get all products
        $products = $this->productModel->all();
        
        // Format products for the view
        $formattedProducts = array_map([$this->productModel, 'formatProduct'], $products);
        
        // Get unique categories for filters
        $categories = array_unique(array_column($formattedProducts, 'category'));
        sort($categories);

        $data = [
            'title' => 'Shop - Lumina',
            'products' => $formattedProducts,
            'categories' => $categories,
            'active_category' => $_GET['category'] ?? null,
            'sort_by' => $_GET['sort'] ?? 'featured'
        ];
        
        $this->view('products', $data);
    }

    public function show($id)
    {
        // Find the product by ID
        $product = $this->productModel->find($id);

        if (!$product) {
            // Product not found, redirect to 404
            header('HTTP/1.0 404 Not Found');
            $this->view('errors/404', ['title' => 'Product Not Found']);
            return;
        }

        // Format the product for the view
        $formattedProduct = $this->productModel->formatProduct($product);

        // Get related products (same category, excluding current product)
        $db = \App\Core\Database::getInstance();
        $related = $db->query(
            "SELECT * FROM products 
             WHERE category = :category AND id != :id 
             LIMIT 4",
            [
                'category' => $product['category'],
                'id' => $id
            ]
        )->fetchAll(\PDO::FETCH_ASSOC);

        // Format related products
        $relatedProducts = array_map([$this->productModel, 'formatProduct'], $related);

        $data = [
            'title' => $formattedProduct['name'] . ' - Lumina',
            'product' => $formattedProduct,
            'relatedProducts' => $relatedProducts
        ];
        
        $this->view('product', $data);
    }
}
