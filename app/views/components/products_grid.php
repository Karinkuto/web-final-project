<?php

/**
 * Products Grid Component
 *
 * @param array $products Array of product data
 * @param string $title Section title
 * @param string $subtitle Section subtitle
 * @param string $viewAllUrl URL for view all link
 * @param bool $isAdmin Whether to show admin actions
 * @param array $gridClasses Custom grid classes (default: 'grid-cols-2 md:grid-cols-3 lg:grid-cols-4')
 */
$isAdmin = $isAdmin ?? false;
$gridClasses = $gridClasses ?? 'grid-cols-2 md:grid-cols-3 lg:grid-cols-4';
?>
<div class="py-6 md:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if (!empty($title) || !empty($viewAllUrl)): ?>
        <div class="flex justify-between items-center mb-6">
            <?php if (!empty($title)): ?>
            <div>
                <h2 class="text-xl md:text-2xl font-bold text-[rgb(var(--color-primary))]"><?= htmlspecialchars($title) ?></h2>
                <?php if (!empty($subtitle)): ?>
                    <p class="text-[rgba(var(--color-primary),0.8)]"><?= htmlspecialchars($subtitle) ?></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($viewAllUrl)): ?>
                <a href="<?= htmlspecialchars($viewAllUrl) ?>" class="text-sm font-medium text-[rgb(var(--color-accent))] hover:text-[rgb(var(--color-accent-hover))] flex items-center">
                    View all
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($products)): ?>
            <div class="grid <?= $gridClasses ?> gap-4 md:gap-6">
                <?php foreach ($products as $product): ?>
                    <?php 
                    $actions = [];
                    if ($isAdmin) {
                        $actions = [
                            [
                                'url' => "/admin/products/edit/{$product['id']}",
                                'label' => 'Edit',
                                'icon' => '<svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>'
                            ],
                            [
                                'type' => 'form',
                                'url' => "/admin/products/delete/{$product['id']}",
                                'method' => 'DELETE',
                                'label' => 'Delete',
                                'variant' => 'danger',
                                'confirm' => 'Are you sure you want to delete this product?',
                                'icon' => '<svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>'
                            ]
                        ];
                    }

                    // Include the card partial with the product data and actions
                    $cardVars = [
                        'item' => $product,
                        'type' => 'product',
                        'class' => 'group flex flex-col h-full',
                        'showActions' => $isAdmin,
                        'actions' => $actions,
                        'isAdmin' => $isAdmin
                    ];
                    extract($cardVars);
                    include __DIR__ . '/../partials/card.php'; 
                    ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <p class="text-[rgba(var(--color-primary),0.7)]">No products found.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
