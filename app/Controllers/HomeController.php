<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product as ProductModel;

class HomeController extends Controller
{
    protected $productModel;

    public function __construct(ProductModel $productModel = null)
    {
        $this->productModel = $productModel ?? new ProductModel();
    }

    public function index()
    {
        // Get featured collections (categories with product counts)
        $featuredCollections = $this->getFeaturedCollections();

        // Get new arrivals (latest products)
        $newArrivals = $this->productModel->getNewArrivals(8);
        
        // Get featured products
        $featuredProducts = $this->productModel->getFeatured(8);

        // Get all products for the products grid if needed
        $allProducts = $this->productModel->all();
        $formattedProducts = array_map([$this->productModel, 'formatProduct'], $allProducts);

        $data = [
            'title' => 'Lumina - Modern Furniture & Home Decor',
            'featuredCollections' => $featuredCollections,
            'newArrivals' => $newArrivals,
            'featuredProducts' => $featuredProducts,
            'products' => $formattedProducts, // For the products grid
            'categories' => array_unique(array_column($formattedProducts, 'category'))
        ];

        $this->view('home', $data);
    }

    /**
     * Get featured collections with product counts
     */
    protected function getFeaturedCollections()
    {
        $categories = [
            'living-room' => 'Living Room',
            'dining-room' => 'Dining Room',
            'bedroom' => 'Bedroom',
            'home-office' => 'Home Office'
        ];

        $collections = [];
        
        // Get product counts for each category and only include non-empty categories
        foreach ($categories as $slug => $name) {
            $count = $this->productModel->getCountByCategory($slug);
            if ($count > 0) {
                $collections[] = [
                    'id' => $slug,
                    'title' => $name,
                    'item_count' => $count,
                    'image_url' => $this->getCategoryImage($slug),
                    'url' => "/collections/{$slug}"
                ];
            }
        }

        // If no collections have items, return an empty array
        return $collections;
    }

    /**
     * Get a category image URL based on category slug
     */
    protected function getCategoryImage($categorySlug)
    {
        $images = [
            'living-room' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
            'dining-room' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1558&q=80',
            'bedroom' => 'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1480&q=80',
            'home-office' => 'https://images.unsplash.com/photo-1583845112203-293299e470a7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
        ];

        return $images[$categorySlug] ?? 'https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80';
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
