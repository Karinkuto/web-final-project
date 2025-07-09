<?php
/**
 * Product Card Component
 * 
 * @param array $product Product data with keys: id, title, price, image_url, url, is_favorite
 */
?>
<div class="group">
    <a href="<?= htmlspecialchars($product['url']) ?>" class="block">
        <div class="aspect-square bg-gray-100 rounded-xl overflow-hidden mb-3 relative">
            <img src="<?= htmlspecialchars($product['image_url']) ?>" 
                 alt="<?= htmlspecialchars($product['title']) ?>" 
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            <div class="absolute top-3 right-3">
                <button type="button" 
                        class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm hover:shadow-md transition-all hover:scale-110"
                        data-product-id="<?= (int)$product['id'] ?>"
                        data-favorite="<?= $product['is_favorite'] ? 'true' : 'false' ?>">
                    <svg class="w-4 h-4 <?= $product['is_favorite'] ? 'text-red-500 fill-current' : 'text-primary' ?>" 
                         fill="<?= $product['is_favorite'] ? 'currentColor' : 'none' ?>" 
                         stroke="currentColor" 
                         viewBox="0 0 24 24" 
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </button>
            </div>
        </div>
        <h3 class="font-medium text-primary"><?= htmlspecialchars($product['title']) ?></h3>
        <p class="text-sm text-primary/70">$<?= number_format($product['price'], 2) ?></p>
    </a>
</div>
