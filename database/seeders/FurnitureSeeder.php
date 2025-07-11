<?php

require_once __DIR__ . '/../../app/Core/Database.php';

$db = App\Core\Database::getInstance()->getConnection();

try {
    // Clear existing products
    $db->exec("DELETE FROM products");
    $db->exec("DELETE FROM sqlite_sequence WHERE name='products'");

    // Sample furniture products
    $furnitureProducts = [
        [
            'name' => 'Modern Velvet Sofa',
            'description' => 'Luxurious velvet sofa with wooden legs. Perfect for modern living rooms. Features high-density foam cushions and a sturdy wooden frame.',
            'price' => 1299.99,
            'original_price' => 1599.99,
            'image_url' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
            'images' => json_encode([
                'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'https://images.unsplash.com/photo-1567016432779-094069958ea5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1480&q=80',
                'https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80'
            ]),
            'category' => 'living-room',
            'colors' => json_encode([
                ['name' => 'Emerald Green', 'value' => '#10b981'],
                ['name' => 'Navy Blue', 'value' => '#1e40af'],
                ['name' => 'Blush Pink', 'value' => '#ec4899']
            ]),
            'materials' => json_encode([
                ['name' => 'Velvet Upholstery', 'value' => 'velvet'],
                ['name' => 'Solid Wood Frame', 'value' => 'wood'],
                ['name' => 'High-density Foam Cushions', 'value' => 'foam']
            ]),
            'in_stock' => 1,
            'is_new' => 1,
            'is_featured' => 1,
            'materials' => json_encode(['Velvet', 'Wood', 'High-density Foam']),
            'dimensions' => '84"W x 36"D x 32"H'
        ],
        [
            'name' => 'Industrial Dining Table',
            'description' => 'Solid wood dining table with black iron base. Seats 6-8 people comfortably. Perfect for both casual and formal dining.',
            'price' => 899.99,
            'original_price' => 1099.99,
            'image_url' => 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
            'images' => json_encode([
                'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'https://images.unsplash.com/photo-1556910639-9e73339e2d56?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'https://images.unsplash.com/photo-1556911221-ef4f7d0e7b1b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80'
            ]),
            'category' => 'dining-room',
            'colors' => json_encode([
                ['name' => 'Reclaimed Wood', 'value' => '#7f1d1d'],
                ['name' => 'Walnut', 'value' => '#431407']
            ]),
            'in_stock' => 1,
            'is_new' => 1,
            'materials' => json_encode(['Reclaimed Wood', 'Iron']),
            'in_stock' => 1,
            'is_new' => 1,
            'is_featured' => 1,
            'dimensions' => '96"L x 42"W x 30"H'
        ],
        [
            'name' => 'Upholstered Platform Bed',
            'description' => 'Queen size platform bed with upholstered headboard. Includes wooden slats for mattress support, no box spring needed.',
            'price' => 699.99,
            'original_price' => 899.99,
            'image_url' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
            'images' => json_encode([
                'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'https://images.unsplash.com/photo-1505693314120-26c4adf9c21d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80'
            ]),
            'category' => 'bedroom',
            'colors' => json_encode([
                ['name' => 'Charcoal', 'value' => '#1f2937'],
                ['name' => 'Oatmeal', 'value' => '#e5e7eb']
            ]),
            'is_new' => 1,
            'is_featured' => 1,
            'materials' => json_encode(['Linen', 'Wood', 'Metal']),
            'dimensions' => '85"L x 65"W x 50"H (Queen)'
        ],
        [
            'name' => 'Ergonomic Office Chair',
            'description' => 'Premium ergonomic office chair with lumbar support and adjustable armrests. Perfect for long work sessions.',
            'price' => 349.99,
            'original_price' => 429.99,
            'image_url' => 'https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
            'images' => json_encode([
                'https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'https://images.unsplash.com/photo-1598300042229-8a9a2a26f9b1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'https://images.unsplash.com/photo-1598300042229-8a9a2a26f9b1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80'
            ]),
            'category' => 'home-office',
            'colors' => json_encode([
                ['name' => 'Black', 'value' => '#000000'],
                ['name' => 'Gray', 'value' => '#6b7280']
            ]),
            'in_stock' => 1,
            'is_new' => 1,
            'is_featured' => 1,
            'materials' => json_encode(['Mesh', 'Aluminum', 'Memory Foam']),
            'dimensions' => '27"W x 27"D x 45"H'
        ],
        [
            'name' => 'Mid-Century Sideboard',
            'description' => 'Vintage-inspired sideboard with ample storage. Features four drawers and two cabinet doors with removable shelves.',
            'price' => 1299.99,
            'original_price' => 1499.99,
            'image_url' => 'https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
            'images' => json_encode([
                'https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80'
            ]),
            'category' => 'living-room',
            'colors' => json_encode([
                ['name' => 'Walnut', 'value' => '#431407'],
                ['name' => 'White Oak', 'value' => '#d6d3d1']
            ]),
            'in_stock' => 1,
            'is_new' => 0,
            'is_featured' => 1,
            'materials' => json_encode(['Solid Wood', 'Brass Hardware']),
            'dimensions' => '72"W x 18"D x 32"H'
        ]
    ];

    $stmt = $db->prepare("
        INSERT INTO products 
        (name, description, price, original_price, image_url, category, colors, in_stock, is_new, is_featured, created_at, updated_at)
        VALUES 
        (:name, :description, :price, :original_price, :image_url, :category, :colors, :in_stock, :is_new, :is_featured, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
    ");

    foreach ($furnitureProducts as $product) {
        $stmt->execute([
            ':name' => $product['name'],
            ':description' => $product['description'],
            ':price' => $product['price'],
            ':original_price' => $product['original_price'] ?? null,
            ':image_url' => $product['image_url'],
            ':category' => $product['category'],
            ':colors' => $product['colors'],
            ':in_stock' => $product['in_stock'] ? 1 : 0,
            ':is_new' => $product['is_new'] ? 1 : 0,
            ':is_featured' => $product['is_featured'] ? 1 : 0
        ]);
    }

    echo "Furniture data seeded successfully!\n";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage() . "\n");
}
