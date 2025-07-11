<?php

namespace App\Controllers;

use App\Core\Controller;

class CartController extends Controller
{
    public function index()
    {
        // Sample cart data with direct Unsplash image URLs
        $cartItems = [
            [
                'id' => 1,
                'name' => 'Classic White Tee',
                'price' => 29.99,
                'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=880&q=80',
                'size' => 'M',
                'quantity' => 1,
                'color' => 'White'
            ],
            [
                'id' => 2,
                'name' => 'Slim Fit Jeans',
                'price' => 59.99,
                'image' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1026&q=80',
                'size' => 'L',
                'quantity' => 1,
                'color' => 'Blue'
            ]
        ];

        // Calculate totals
        $subtotal = array_reduce($cartItems, function($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        $shipping = 0; // Free shipping
        $taxRate = 0.08; // 8% tax rate
        $estimatedTax = $subtotal * $taxRate;
        $total = $subtotal + $shipping + $estimatedTax;

        $data = [
            'title' => 'Shopping Bag - Lumina',
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'estimatedTax' => $estimatedTax,
            'total' => $total
        ];

        $this->view('cart', $data);
    }
}
