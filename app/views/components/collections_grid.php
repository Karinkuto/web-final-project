<?php
/**
 * Collections Grid Component
 * 
 * @param array $collections Array of collection data
 * @param string $title Section title
 * @param string $subtitle Section subtitle (optional)
 * @param string $viewAllUrl URL for view all link (optional)
 */
?>
<div class="py-12 md:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <?php if (!empty($title)): ?>
                    <h2 class="text-2xl md:text-3xl font-bold text-primary"><?= htmlspecialchars($title) ?></h2>
                <?php endif; ?>
                <?php if (!empty($subtitle)): ?>
                    <p class="text-primary/80"><?= htmlspecialchars($subtitle) ?></p>
                <?php endif; ?>
            </div>
            <?php if (!empty($viewAllUrl)): ?>
                <a href="<?= htmlspecialchars($viewAllUrl) ?>" class="text-sm font-medium text-accent hover:text-accent-hover">
                    View all →
                </a>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php foreach ($collections as $collection): ?>
                <?php include __DIR__ . '/collection_card.php'; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
