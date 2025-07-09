<?php

/**
 * Products Grid Component
 *
 * @param array $products Array of product data
 * @param string $title Section title
 * @param string $subtitle Section subtitle
 * @param string $viewAllUrl URL for view all link
 */
?>
<div class="py-12 md:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-primary"><?= htmlspecialchars($title) ?></h2>
                <p class="text-primary/80"><?= htmlspecialchars($subtitle) ?></p>
            </div>
            <?php if (!empty($viewAllUrl)): ?>
                <a href="<?= htmlspecialchars($viewAllUrl) ?>" class="text-sm font-medium text-accent hover:text-accent-hover flex items-center">
                    View all
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php foreach ($products as $product): ?>
                <?php include __DIR__ . '/product_card.php'; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
