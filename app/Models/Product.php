<?php

namespace App\Models;

class Product extends Model {
    protected $table = 'products';

    /**
     * @param ?\PDO $db Database connection
     */
    public function __construct(\PDO $db = null) {
        parent::__construct($db);
    }

    /**
     * Get featured products
     *
     * @param int $limit Number of products to return
     * @return array
     */
    public function getFeatured($limit = 8) {
        return $this->getFeaturedProducts($limit);
    }

    /**
     * Get featured products (alias for getFeatured)
     *
     * @param int $limit Number of products to return
     * @return array
     */
    public function getFeaturedProducts($limit = 8) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE is_featured = 1 LIMIT :limit");
        $stmt->bindValue(':limit', (int)$limit, \PDO::PARAM_INT);
        $stmt->execute();
        $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Format products for the view
        return array_map([$this, 'formatProduct'], $products);
    }

    /**
     * Get new arrival products
     *
     * @param int $limit Number of products to return
     * @return array
     */
    public function getNewArrivals($limit = 4) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT :limit");
        $stmt->bindValue(':limit', (int)$limit, \PDO::PARAM_INT);
        $stmt->execute();
        $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Format products for the view
        return array_map([$this, 'formatProduct'], $products);
    }

    /**
     * Convert database row to the format expected by our views
     *
     * @param array $product The product data from the database
     * @return array Formatted product data
     */
    /**
     * Get the count of products in a specific category
     *
     * @param string $categorySlug The category slug to count products for
     * @return int The number of products in the category
     */
    public function getCountByCategory($categorySlug) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM {$this->table} WHERE category = :category");
        $stmt->bindValue(':category', $categorySlug, \PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return (int)($result['count'] ?? 0);
    }

    /**
     * Convert database row to the format expected by our views
     *
     * @param array $product The product data from the database
     * @return array Formatted product data
     */
    public function formatProduct($product) {
        $name = $product['name'] ?? '';

        return [
            'id' => $product['id'] ?? null,
            // Keep both 'name' and 'title' for backward compatibility
            'name' => $name,
            'title' => $name,
            'price' => isset($product['price']) ? (float)$product['price'] : 0.0,
            'original_price' => isset($product['original_price']) && $product['original_price'] !== null ? (float)$product['original_price'] : null,
            'image_url' => $product['image_url'] ?? '',
            'images' => !empty($product['images']) ? (is_array($product['images']) ? $product['images'] : json_decode($product['images'], true)) : [],
            'category' => $product['category'] ?? '',
            'in_stock' => isset($product['in_stock']) ? (bool)$product['in_stock'] : false,
            'is_new' => isset($product['is_new']) ? (bool)$product['is_new'] : false,
            'is_featured' => isset($product['is_featured']) ? (bool)$product['is_featured'] : false,
            'description' => $product['description'] ?? '',
            'colors' => !empty($product['colors']) ? (is_array($product['colors']) ? $product['colors'] : json_decode($product['colors'], true)) : [],
            'variants' => !empty($product['variants']) ? (is_array($product['variants']) ? $product['variants'] : json_decode($product['variants'], true)) : [],
            'created_at' => $product['created_at'] ?? null,
            // Add any additional fields that might be needed
            'materials' => !empty($product['materials']) ? (is_array($product['materials']) ? $product['materials'] : json_decode($product['materials'], true)) : [],
            'sizes' => !empty($product['sizes']) ? (is_array($product['sizes']) ? $product['sizes'] : json_decode($product['sizes'], true)) : []
        ];
    }
}
