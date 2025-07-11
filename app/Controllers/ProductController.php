<?php

namespace App\Controllers;

use App\Core\Controller;

class ProductController extends Controller
{
    /**
     * Get all products
     * 
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }
    // Sample furniture product data
    private $products = [
        [
            'id' => 1,
            'name' => 'Modern Velvet Sofa',
            'brand' => 'Luxury Living',
            'price' => 1299.99,
            'original_price' => 1499.99,
            'image' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
            'images' => [
                'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'https://images.unsplash.com/photo-1517705008128-361805f42e86?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'
            ],
            'category' => 'Sofas',
            'description' => 'Elegant modern sofa with velvet upholstery and solid wood legs. Perfect for contemporary living rooms, this sofa combines comfort with sophisticated design.',
            'features' => [
                'Plush velvet upholstery',
                'Solid oak wood legs',
                'High-density foam cushions',
                'Removable seat cushions',
                'Available in multiple colors'
            ],
            'dimensions' => [
                'Width' => '220 cm',
                'Depth' => '95 cm',
                'Height' => '85 cm',
                'Seat Height' => '45 cm',
                'Arm Height' => '65 cm'
            ],
            'dimensions_image' => 'https://images.unsplash.com/photo-1556228578-9d572c7b373e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
            'materials' => [
                ['name' => 'Velvet', 'value' => 'velvet'],
                ['name' => 'Linen', 'value' => 'linen'],
                ['name' => 'Leather', 'value' => 'leather']
            ],
            'materials_description' => 'High-quality velvet upholstery with a soft, luxurious feel. Frame made from kiln-dried hardwood for durability. Cushions filled with high-resilient foam and fiber blend.',
            'colors' => [
                ['name' => 'Emerald Green', 'value' => '#10b981'],
                ['name' => 'Navy Blue', 'value' => '#1e40af'],
                ['name' => 'Blush Pink', 'value' => '#db2777'],
                ['name' => 'Charcoal', 'value' => '#1f2937']
            ],
            'care_instructions' => [
                'Vacuum regularly with an upholstery attachment',
                'Blot spills immediately with a clean, dry cloth',
                'Professional cleaning recommended every 12-18 months',
                'Rotate cushions regularly to ensure even wear'
            ],
            'is_new' => true,
            'rating' => 4.7,
            'review_count' => 89,
            'in_stock' => true,
            'sku' => 'SOFA-MOD-VEL-001',
            'weight' => '85 kg',
            'warranty' => '5 years',
            'assembly_required' => 'Minimal assembly required',
            'lead_time' => '2-4 weeks',
            'shipping' => 'Free shipping on all orders',
            'returns' => '30-day return policy'
        ],
        [
            'id' => 2,
            'name' => 'Industrial Dining Table',
            'brand' => 'Urban Loft',
            'price' => 899.99,
            'image' => 'https://images.unsplash.com/photo-1565538810643-b5bdb714032a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
            'images' => [
                'https://images.unsplash.com/photo-1565538810643-b5bdb714032a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'https://images.unsplash.com/photo-1600499501461-5adad8ae6d85?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'https://images.unsplash.com/photo-1598300056393-4aac492f4344?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'
            ],
            'category' => 'Dining Tables',
            'description' => 'Sturdy industrial-style dining table with a reclaimed wood top and black metal frame. Perfect for both modern and rustic dining spaces.',
            'features' => [
                'Solid reclaimed wood tabletop',
                'Powder-coated steel frame',
                'Industrial pipe-style legs',
                'Seats up to 6 people',
                'Distressed finish for character'
            ],
            'dimensions' => [
                'Length' => '200 cm',
                'Width' => '100 cm',
                'Height' => '76 cm',
                'Table Top Thickness' => '4 cm'
            ],
            'dimensions_image' => 'https://images.unsplash.com/photo-1592078615290-033ee584e267?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
            'materials' => [
                ['name' => 'Reclaimed Wood', 'value' => 'reclaimed-wood'],
                ['name' => 'Oak', 'value' => 'oak'],
                ['name' => 'Walnut', 'value' => 'walnut']
            ],
            'materials_description' => 'Tabletop crafted from solid reclaimed wood with a natural oil finish. Frame constructed from powder-coated steel for durability and stability.',
            'finishes' => [
                ['name' => 'Natural', 'value' => 'natural'],
                ['name' => 'Dark Walnut', 'value' => 'dark-walnut'],
                ['name' => 'Grey Wash', 'value' => 'grey-wash']
            ],
            'care_instructions' => [
                'Wipe clean with a dry or slightly damp cloth',
                'Use coasters under glasses and hot items',
                'Avoid placing in direct sunlight to prevent fading',
                'Reapply wood oil every 6-12 months to maintain finish'
            ],
            'rating' => 4.8,
            'review_count' => 124,
            'in_stock' => true,
            'sku' => 'TABLE-IND-REC-002',
            'weight' => '65 kg',
            'warranty' => '3 years',
            'assembly_required' => 'Moderate assembly required',
            'lead_time' => '3-5 weeks',
            'shipping' => 'Free shipping on all orders',
            'returns' => '30-day return policy'
        ],
        [
            'id' => 3,
            'name' => 'Mid-Century Armchair',
            'brand' => 'Retro Living',
            'price' => 599.99,
            'original_price' => 749.99,
            'image' => 'https://images.unsplash.com/photo-1503602642458-232111445657?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
            'images' => [
                'https://images.unsplash.com/photo-1503602642458-232111445657?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'https://images.unsplash.com/photo-1592078615290-033ee584e267?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'https://images.unsplash.com/photo-1598300056393-4aac492f4344?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'
            ],
            'category' => 'Armchairs',
            'description' => 'Iconic mid-century modern armchair with walnut legs and premium fabric upholstery. A perfect blend of comfort and timeless design.',
            'features' => [
                'Solid walnut legs',
                'High-resilient foam cushioning',
                'Removable seat cushion',
                'Timeless mid-century design',
                'Available in multiple fabric options'
            ],
            'dimensions' => [
                'Width' => '75 cm',
                'Depth' => '80 cm',
                'Height' => '85 cm',
                'Seat Height' => '45 cm',
                'Arm Height' => '65 cm'
            ],
            'colors' => [
                ['name' => 'Mustard Yellow', 'value' => '#d97706'],
                ['name' => 'Olive Green', 'value' => '#65a30d'],
                ['name' => 'Terracotta', 'value' => '#9a3412']
            ],
            'materials' => [
                ['name' => 'Wool Blend', 'value' => 'wool'],
                ['name' => 'Linen', 'value' => 'linen'],
                ['name' => 'Velvet', 'value' => 'velvet']
            ],
            'materials_description' => 'Premium fabric upholstery with solid walnut legs. Cushions filled with high-density foam for lasting comfort.',
            'care_instructions' => [
                'Spot clean with mild detergent',
                'Professional cleaning recommended',
                'Avoid direct sunlight to prevent fading',
                'Rotate cushions regularly'
            ],
            'is_new' => true,
            'rating' => 4.9,
            'review_count' => 156,
            'in_stock' => true,
            'sku' => 'CHAIR-MID-ARM-003',
            'weight' => '28 kg',
            'warranty' => '5 years',
            'assembly_required' => 'Minimal assembly required',
            'lead_time' => '2-3 weeks',
            'shipping' => 'Free shipping on all orders',
            'returns' => '30-day return policy'
        ]
    ];

    public function index()
    {
        // Get unique categories for filters
        $categories = array_unique(array_column($this->products, 'category'));
        sort($categories);

        $data = [
            'title' => 'Shop - Lumina',
            'products' => $this->products,
            'categories' => $categories,
            'active_category' => $_GET['category'] ?? null,
            'sort_by' => $_GET['sort'] ?? 'featured'
        ];
        
        $this->view('products', $data);
    }

    public function show($id)
    {
        // Find the product by ID
        $product = null;
        foreach ($this->products as $p) {
            if ($p['id'] == $id) {
                $product = $p;
                break;
            }
        }

        if (!$product) {
            // Product not found, redirect to 404
            header('HTTP/1.0 404 Not Found');
            $this->view('errors/404', ['title' => 'Product Not Found']);
            return;
        }

        // Get related products (in a real app, this would be based on category or tags)
        $relatedProducts = array_filter($this->products, function($p) use ($product) {
            return $p['id'] != $product['id'] && $p['category'] === $product['category'];
        });
        $relatedProducts = array_slice($relatedProducts, 0, 4); // Limit to 4 related products

        $data = [
            'title' => $product['name'] . ' - Lumina',
            'product' => $product,
            'relatedProducts' => $relatedProducts
        ];
        
        $this->view('product', $data);
    }
}
