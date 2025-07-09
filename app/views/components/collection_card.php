<?php
/**
 * Collection Card Component
 * 
 * @param array $collection Collection data with keys: id, title, item_count, image_url, url
 */
?>
<div class="group">
    <a href="<?= htmlspecialchars($collection['url']) ?>" class="block">
        <div class="aspect-square bg-gray-100 rounded-xl overflow-hidden mb-3 relative">
            <img src="<?= htmlspecialchars($collection['image_url']) ?>" 
                 alt="<?= htmlspecialchars($collection['title']) ?>" 
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        </div>
        <h3 class="font-medium text-primary"><?= htmlspecialchars($collection['title']) ?></h3>
        <p class="text-sm text-primary/70"><?= (int)$collection['item_count'] ?> items</p>
    </a>
</div>
