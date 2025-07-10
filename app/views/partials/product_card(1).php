<div class="group relative">
    <!-- Product Image -->
    <div class="aspect-square w-full overflow-hidden rounded-lg bg-gray-200">
        <a href="/products/<?= $product['id'] ?>">
            <img src="<?= htmlspecialchars($product['image']) ?>"
                alt="<?= htmlspecialchars($product['name']) ?>"
                class="h-full w-full object-cover object-center transition duration-300 group-hover:opacity-90">
        </a>

        <!-- Sale Badge -->
        <?php if (isset($product['original_price'])): ?>
            <div class="absolute top-2 right-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                Sale
            </div>
        <?php endif; ?>

        <!-- New Badge -->
        <?php if (!empty($product['is_new'])): ?>
            <div class="absolute top-2 left-2 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                New
            </div>
        <?php endif; ?>
    </div>

    <!-- Product Info -->
    <div class="mt-4">
        <!-- Category -->
        <p class="text-sm text-gray-500"><?= htmlspecialchars($product['category'] ?? '') ?></p>

        <!-- Product Name -->
        <h3 class="mt-1 text-sm font-medium text-gray-900">
            <a href="/products/<?= $product['id'] ?>">
                <span aria-hidden="true" class="absolute inset-0"></span>
                <?= htmlspecialchars($product['name']) ?>
            </a>
        </h3>

        <!-- Price -->
        <div class="mt-2 flex items-center">
            <p class="text-base font-medium text-gray-900">$<?= number_format($product['price'], 2) ?></p>
            <?php if (isset($product['original_price'])): ?>
                <p class="ml-2 text-sm text-gray-500 line-through">$<?= number_format($product['original_price'], 2) ?></p>
            <?php endif; ?>
        </div>

        <!-- Rating -->
        <?php if (isset($product['rating'])): ?>
            <div class="mt-2 flex items-center">
                <div class="flex items-center">
                    <?php
                    $fullStars = floor($product['rating']);
                    $hasHalfStar = $product['rating'] - $fullStars >= 0.5;
                    $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);

                    // Full stars
                    for ($i = 0; $i < $fullStars; $i++): ?>
                        <svg class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    <?php endfor; ?>

                    <!-- Half star -->
                    <?php if ($hasHalfStar): ?>
                        <svg class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <defs>
                                <linearGradient id="half-star" x1="0" x2="100%" y1="0" y2="0">
                                    <stop offset="50%" stop-color="currentColor" />
                                    <stop offset="50%" stop-color="#D1D5DB" />
                                </linearGradient>
                            </defs>
                            <path fill="url(#half-star)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    <?php endif; ?>

                    <!-- Empty stars -->
                    <?php for ($i = 0; $i < $emptyStars; $i++): ?>
                        <svg class="h-4 w-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    <?php endfor; ?>
                </div>
                <?php if (isset($product['review_count'])): ?>
                    <span class="ml-1 text-xs text-gray-500">(<?= $product['review_count'] ?>)</span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Color Swatches -->
        <?php if (!empty($product['colors']) && is_array($product['colors'])): ?>
            <div class="mt-2 flex space-x-1">
                <?php foreach ($product['colors'] as $color):
                    $colorValue = is_array($color) ? $color['value'] : $color;
                    $colorName = is_array($color) ? $color['name'] : ucfirst($color);
                    $colorClass = is_array($color) && isset($color['class']) ? $color['class'] : 'bg-' . $colorValue;
                ?>
                    <span class="h-4 w-4 rounded-full border border-gray-200 <?= $colorClass ?>" title="<?= htmlspecialchars($colorName) ?>">
                        <span class="sr-only"><?= htmlspecialchars($colorName) ?></span>
                    </span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
