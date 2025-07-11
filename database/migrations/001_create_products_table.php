<?php

require_once __DIR__ . '/../../app/Core/Database.php';

$db = App\Core\Database::getInstance()->getConnection();

try {
    // Create products table
    $db->exec("
        CREATE TABLE IF NOT EXISTS products (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            description TEXT,
            price DECIMAL(10, 2) NOT NULL,
            original_price DECIMAL(10, 2),
            image_url TEXT,
            category TEXT,
            colors TEXT, -- JSON array of colors
            variants TEXT, -- JSON array of variants
            in_stock BOOLEAN DEFAULT 1,
            is_new BOOLEAN DEFAULT 0,
            is_featured BOOLEAN DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    echo "Database tables created successfully!\n";

    // Insert sample data
    $sampleProducts = [
        [
            'name' => 'Minimalist Sneaker',
            'description' => 'Clean and comfortable sneaker for everyday wear',
            'price' => 89.99,
            'original_price' => 119.99,
            'image_url' => '/images/products/sneaker.jpg',
            'category' => 'Shoes',
            'colors' => json_encode([
                ['name' => 'White', 'value' => '#ffffff'],
                ['name' => 'Black', 'value' => '#000000']
            ]),
            'in_stock' => 1,
            'is_new' => 1,
            'is_featured' => 1
        ],
        // Add more sample products as needed
    ];

    $stmt = $db->prepare("
        INSERT INTO products 
        (name, description, price, original_price, image_url, category, colors, in_stock, is_new, is_featured)
        VALUES 
        (:name, :description, :price, :original_price, :image_url, :category, :colors, :in_stock, :is_new, :is_featured)
    ");

    foreach ($sampleProducts as $product) {
        $stmt->execute($product);
    }

    echo "Sample data inserted successfully!\n";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage() . "\n");
}
