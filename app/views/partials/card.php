<?php
/**
 * Generic Card Component
 * 
 * @param array $item The item data (product or collection)
 * @param string $type The type of card ('product' or 'collection')
 * @param string $class Additional CSS classes
 * @param bool $showActions Whether to show action buttons (add to cart, etc.)
 * @param array $actions Array of action buttons to display
 * @param bool $isAdmin Whether to show admin-specific actions
 */
$item = $item ?? [];
$type = $type ?? 'product';
$class = $class ?? '';
$showActions = $showActions ?? true;
$actions = $actions ?? [];
$isAdmin = $isAdmin ?? false;

// Common fields
$id = $item['id'] ?? 0;
$title = $item['title'] ?? ($item['name'] ?? 'Item');
$image = $item['image_url'] ?? ($item['image'] ?? '');
$url = $item['url'] ?? (($type === 'product') ? "/products/$id" : "/collections/$id");
$inStock = $item['in_stock'] ?? true;

// Type-specific fields
$category = $item['category'] ?? '';
$itemCount = $item['item_count'] ?? null;
$price = $item['price'] ?? 0;
$originalPrice = $item['original_price'] ?? 0;
$isNew = $item['is_new'] ?? false;
$colors = $item['colors'] ?? [];
$variants = $item['variants'] ?? [];

// Calculate discount percentage
$discount = 0;
if ($originalPrice > 0 && $price < $originalPrice) {
    $discount = round((($originalPrice - $price) / $originalPrice) * 100);
}
?>

<div class="card <?= htmlspecialchars($class, ENT_QUOTES, 'UTF-8') ?>" onclick="if(!event.target.closest('a, button, [role=button]')) window.location='<?= htmlspecialchars($url, ENT_QUOTES, 'UTF-8') ?>'" style="cursor: pointer;">
    <!-- Image Container -->
    <div class="card-image-container">
        <!-- Main Image -->
        <div class="h-full w-full">
            <?php if (!empty($image)): ?>
                <div class="block h-full w-full">
                    <img src="<?= htmlspecialchars($image, ENT_QUOTES, 'UTF-8') ?>"
                        alt="<?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>"
                        class="card-image w-full h-full object-cover">
                </div>
            <?php else: ?>
                <div class="h-full w-full bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400">No image</span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Badges -->
        <div class="card-badge">
            <?php if ($isNew): ?>
                <div class="badge badge-new">
                    New
                </div>
            <?php endif; ?>
            
            <?php if ($type === 'product' && !$inStock): ?>
                <div class="badge badge-out-of-stock">
                    Out of Stock
                </div>
            <?php endif; ?>
        </div>

        <!-- Sale/Discount Badge -->
        <?php if ($type === 'product' && $originalPrice > 0 && $price < $originalPrice): ?>
            <div class="badge-sale">
                <?= $discount > 0 ? "-$discount%" : 'Sale' ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Content -->
    <div class="card-content">
        <?php if (!empty($category) || $itemCount !== null): ?>
            <p class="card-category">
                <?= !empty($category) ? htmlspecialchars($category, ENT_QUOTES, 'UTF-8') : '' ?>
                <?php if ($itemCount !== null): ?>
                    <?= !empty($category) ? '•' : '' ?>
                    <?= $itemCount . ' ' . ($itemCount === 1 ? 'item' : 'items') ?>
                <?php endif; ?>
            </p>
        <?php endif; ?>

        <h3 class="card-title">
            <?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>
        </h3>

        <!-- Price -->
        <?php if ($type === 'product' && $price > 0): ?>
            <div class="card-price">
                <p class="card-price-current">$<?= number_format($price, 2) ?></p>
                <?php if ($originalPrice > 0 && $price < $originalPrice): ?>
                    <p class="card-price-original">$<?= number_format($originalPrice, 2) ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Color Swatches -->
        <?php if ($type === 'product' && !empty($colors)): ?>
            <div class="card-colors">
                <?php 
                // If $colors is an indexed array of color values
                if (isset($colors[0]) && is_string($colors[0])): 
                    foreach ($colors as $colorValue): 
                        $colorName = is_string($colorValue) ? $colorValue : 'Color';
                        $colorHex = $this->getColorHex($colorValue); // You'll need to implement this helper
                        ?>
                        <span 
                            class="color-swatch"
                            style="background-color: <?= htmlspecialchars($colorHex, ENT_QUOTES, 'UTF-8') ?>"
                            title="<?= htmlspecialchars($colorName, ENT_QUOTES, 'UTF-8') ?>"
                        ></span>
                    <?php endforeach; 
                // If $colors is an associative array with color data
                else: 
                    foreach ($colors as $color): 
                        $colorHex = $color['hex'] ?? $color['color'] ?? $color['value'] ?? '#CCCCCC';
                        $colorName = $color['name'] ?? 'Color';
                        ?>
                        <span 
                            class="color-swatch"
                            style="background-color: <?= htmlspecialchars($colorHex, ENT_QUOTES, 'UTF-8') ?>"
                            title="<?= htmlspecialchars($colorName, ENT_QUOTES, 'UTF-8') ?>"
                        ></span>
                    <?php endforeach; 
                endif; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <?php if ($showActions && !empty($actions)): ?>
        <div class="mt-auto p-4 border-t border-[rgb(var(--color-border))]">
            <div class="flex space-x-2">
                <?php foreach ($actions as $action): ?>
                    <?php if (isset($action['type']) && $action['type'] === 'form'): ?>
                        <form action="<?= htmlspecialchars($action['url'] ?? '#', ENT_QUOTES, 'UTF-8') ?>" 
                              method="POST" 
                              class="flex-1"
                              onsubmit="event.stopPropagation(); return confirm('<?= htmlspecialchars($action['confirm'] ?? 'Are you sure?', ENT_QUOTES, 'UTF-8') ?>');">
                            <?php if (isset($action['method']) && strtoupper($action['method']) !== 'POST'): ?>
                                <input type="hidden" name="_method" value="<?= htmlspecialchars($action['method'], ENT_QUOTES, 'UTF-8') ?>">
                            <?php endif; ?>
                            <button type="submit" 
                                    onclick="event.stopPropagation();"
                                    class="w-full inline-flex justify-center items-center px-4 py-2 border <?= $action['variant'] === 'danger' ? 'border-transparent text-white bg-[rgb(var(--color-accent))] hover:bg-[rgba(var(--color-accent),0.9)]' : 'border-[rgb(var(--color-border))] text-[rgb(var(--color-primary))] bg-[rgb(var(--color-surface))] hover:bg-[rgba(var(--color-primary),0.05)]' ?> rounded-lg text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[rgb(var(--color-accent))] transition-colors">
                                <?php if (!empty($action['icon'])): ?>
                                    <span class="mr-2"><?= $action['icon'] ?></span>
                                <?php endif; ?>
                                <?= htmlspecialchars($action['label'] ?? 'Action', ENT_QUOTES, 'UTF-8') ?>
                            </button>
                        </form>
                    <?php else: ?>
                        <a href="<?= htmlspecialchars($action['url'] ?? '#', ENT_QUOTES, 'UTF-8') ?>" 
                           onclick="event.stopPropagation();"
                           class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-[rgb(var(--color-border))] rounded-lg text-sm font-medium text-[rgb(var(--color-primary))] bg-[rgb(var(--color-surface))] hover:bg-[rgba(var(--color-primary),0.03)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[rgb(var(--color-accent))] transition-colors">
                            <?php if (!empty($action['icon'])): ?>
                                <span class="mr-2"><?= $action['icon'] ?></span>
                            <?php endif; ?>
                            <?= htmlspecialchars($action['label'] ?? 'Action', ENT_QUOTES, 'UTF-8') ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
