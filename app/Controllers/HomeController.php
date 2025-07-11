<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // Sample data - in a real app, this would come from a model
        $featuredCollections = [
            [
                'id' => 1,
                'title' => 'Living Room',
                'item_count' => 20,
                'image_url' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'url' => '/collections/living-room'
            ],
            [
                'id' => 2,
                'title' => 'Dining Room',
                'item_count' => 15,
                'image_url' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1558&q=80',
                'url' => '/collections/dining-room'
            ],
            [
                'id' => 3,
                'title' => 'Bedroom',
                'item_count' => 18,
                'image_url' => 'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1480&q=80',
                'url' => '/collections/bedroom'
            ],
            [
                'id' => 4,
                'title' => 'Home Office',
                'item_count' => 12,
                'image_url' => 'https://images.unsplash.com/photo-1583845112203-293299e470a7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'url' => '/collections/home-office'
            ]
        ];

        $newArrivals = [
            [
                'id' => 1,
                'title' => 'Modern Armchair',
                'price' => 299.99,
                'image_url' => 'https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'url' => '/products/modern-armchair',
                'is_favorite' => false
            ],
            [
                'id' => 2,
                'title' => 'Coffee Table',
                'price' => 199.99,
                'image_url' => 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80',
                'url' => '/products/coffee-table',
                'is_favorite' => true
            ],
            [
                'id' => 3,
                'title' => 'Floor Lamp',
                'price' => 149.99,
                'image_url' => 'https://images.unsplash.com/photo-1554295405-abb0fd4a74eb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80',
                'url' => '/products/floor-lamp',
                'is_favorite' => false
            ],
            [
                'id' => 4,
                'title' => 'Throw Pillow Set',
                'price' => 49.99,
                'image_url' => 'https://images.unsplash.com/photo-1592078615290-033ee584e267?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1528&q=80',
                'url' => '/products/throw-pillow-set',
                'is_favorite' => false
            ]
        ];

        // Render the home view with data
        // The layout is automatically included by the parent Controller's view() method
        echo $this->view('home', [
            'title' => 'Welcome to Our Store',
            'featuredCollections' => $featuredCollections,
            'newArrivals' => $newArrivals
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
