<div class="container mx-auto px-4 py-8 max-w-7xl">
    <!-- Breadcrumb -->
    <nav class="mb-8" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-2 text-sm">
            <li><a href="/" class="text-gray-500 hover:text-gray-700 transition-colors">Home</a></li>
            <li class="text-gray-300">/</li>
            <li><a href="/products" class="text-gray-500 hover:text-gray-700 transition-colors">Furniture</a></li>
            <?php if (!empty($product['category'])): ?>
                <li class="text-gray-300">/</li>
                <li><a href="/products?category=<?= urlencode($product['category']) ?>" class="text-gray-500 hover:text-gray-700 transition-colors"><?= htmlspecialchars($product['category']) ?></a></li>
            <?php endif; ?>
            <li class="text-gray-300">/</li>
            <li class="text-gray-900 font-medium"><?= htmlspecialchars($product['name']) ?></li>
        </ol>
    </nav>

    <div class="flex flex-col lg:flex-row gap-12">
        <!-- Image gallery -->
        <div class="lg:w-1/2">
            <div class="w-full bg-gray-50 rounded-xl overflow-hidden mb-4 aspect-square">
                <img id="main-image" 
                     src="<?= htmlspecialchars($product['images'][0] ?? '/path/to/placeholder-image.jpg') ?>" 
                     alt="<?= htmlspecialchars($product['name']) ?>" 
                     class="w-full h-full object-cover transition-opacity duration-300"
                     loading="eager">
            </div>
            <?php if (count($product['images'] ?? []) > 1): ?>
                <div class="grid grid-cols-4 gap-3 mt-4">
                    <?php foreach ($product['images'] as $index => $image): ?>
                        <button type="button"
                            class="aspect-square w-full rounded-lg overflow-hidden border-2 transition-all duration-200 <?= $index === 0 ? 'border-secondary' : 'border-gray-200 hover:border-gray-300' ?>"
                            onclick="changeImage('<?= htmlspecialchars($image) ?>', this)"
                            role="tab"
                            aria-selected="<?= $index === 0 ? 'true' : 'false' ?>"
                            tabindex="<?= $index === 0 ? '0' : '-1' ?>">
                            <img src="<?= htmlspecialchars($image) ?>" 
                                 alt="" 
                                 class="w-full h-full object-cover">
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Product details -->
        <div class="lg:w-1/2">
            <!-- Product Header -->
            <div class="mb-4">
                <?php if (!empty($product['is_new'])): ?>
                    <span class="inline-block bg-secondary text-white text-xs font-medium px-2.5 py-1 rounded-full mb-3">New Arrival</span>
                <?php endif; ?>
                
                <h1 class="text-3xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($product['name']) ?></h1>
                
                <?php if (!empty($product['brand'])): ?>
                    <p class="text-gray-600 mb-4">By <?= htmlspecialchars($product['brand']) ?></p>
                <?php endif; ?>
                

            </div>
            
            <!-- Price -->
            <div class="mb-6">
                <p class="text-2xl font-semibold text-gray-900">$<?= number_format($product['price'], 2) ?></p>
                <?php if (isset($product['original_price']) && $product['original_price'] > $product['price']): ?>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-sm text-gray-500 line-through">$<?= number_format($product['original_price'], 2) ?></span>
                        <span class="inline-flex items-center rounded-full bg-red-100 px-2 py-0.5 text-xs font-medium text-red-800">
                            Save <?= number_format((($product['original_price'] - $product['price']) / $product['original_price']) * 100, 0) ?>%
                        </span>
                    </div>
                <?php endif; ?>
            </div>



            <!-- Description -->
            <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-900 mb-2">Description</h3>
                <div class="text-gray-600 text-sm">
                    <?= nl2br(htmlspecialchars($product['description'])) ?>
                </div>
            </div>

            <!-- Variants -->
            <?php if (!empty($product['colors']) || !empty($product['materials']) || !empty($product['sizes'])): ?>
                <div class="space-y-6 mb-8">
                    <?php if (!empty($product['colors'])): ?>
                        <div>
                            <h3 class="text-sm font-medium text-gray-900 mb-2">Color</h3>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach ($product['colors'] as $color): ?>
                                    <label class="relative">
                                        <input type="radio" 
                                               name="color" 
                                               value="<?= htmlspecialchars($color['value']) ?>" 
                                               class="sr-only" 
                                               <?= $color === ($product['colors'][0] ?? null) ? 'checked' : '' ?> 
                                               aria-labelledby="color-choice-<?= htmlspecialchars($color['value']) ?>-label">
                                        <span id="color-choice-<?= htmlspecialchars($color['value']) ?>-label" class="sr-only">
                                            <?= htmlspecialchars($color['name']) ?>
                                        </span>
                                        <span class="h-10 w-10 rounded-md border-2 border-transparent flex items-center justify-center cursor-pointer hover:ring-2 hover:ring-offset-2 hover:ring-secondary/30 transition-all" 
                                              style="background-color: <?= $color['value'] ?>;
                                                     <?= str_contains(strtolower($color['name']), 'white') ? 'border-gray-200' : '' ?>">
                                            <span class="sr-only"><?= htmlspecialchars($color['name']) ?></span>
                                        </span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($product['materials'])): ?>
                        <div>
                            <h3 class="text-sm font-medium text-gray-900 mb-2">Material</h3>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach ($product['materials'] as $material): ?>
                                    <label class="relative">
                                        <input type="radio" 
                                               name="material" 
                                               value="<?= htmlspecialchars($material['value']) ?>" 
                                               class="sr-only" 
                                               <?= $material === ($product['materials'][0] ?? null) ? 'checked' : '' ?>>
                                        <span class="px-4 py-2 border rounded-md text-sm font-medium cursor-pointer hover:bg-gray-50 transition-colors peer-checked:border-secondary peer-checked:ring-1 peer-checked:ring-secondary">
                                            <?= htmlspecialchars($material['name']) ?>
                                        </span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($product['sizes'])): ?>
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-sm font-medium text-gray-900">Size</h3>
                                <a href="#" class="text-sm text-gray-500 hover:text-secondary transition-colors">Size guide</a>
                            </div>
                            <div class="grid grid-cols-4 gap-3">
                                <?php foreach ($product['sizes'] as $size): ?>
                                    <label class="relative flex items-center justify-center rounded-lg border py-3 px-2 text-sm font-medium cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:border-secondary has-[:checked]:ring-1 has-[:checked]:ring-secondary">
                                        <input type="radio" 
                                               name="size" 
                                               value="<?= htmlspecialchars($size) ?>" 
                                               class="sr-only" 
                                               <?= $size === ($product['sizes'][0] ?? null) ? 'checked' : '' ?>>
                                        <span><?= htmlspecialchars($size) ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Quantity -->
            <div class="mt-6">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                <div class="mt-1 flex items-center">
                    <button type="button" 
                            onclick="decrementQuantity()" 
                            class="p-2 text-gray-600 hover:text-gray-700 focus:outline-none">
                        <span class="sr-only">Decrease quantity</span>
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                    </button>
                    <input type="number" 
                           id="quantity" 
                           name="quantity" 
                           min="1" 
                           value="1" 
                           class="w-16 text-center border-0 focus:ring-0 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                    <button type="button" 
                            onclick="incrementQuantity()" 
                            class="p-2 text-gray-600 hover:text-gray-700 focus:outline-none">
                        <span class="sr-only">Increase quantity</span>
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Add to cart -->
            <div class="mt-8">
                <button type="submit" 
                        class="w-full bg-secondary text-white py-3 px-6 rounded-lg font-medium hover:bg-secondary/90 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary/50">
                    Add to bag
                </button>
            </div>

            <!-- Product Information Tabs -->
            <div class="mt-12 border-t border-gray-200 pt-8">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Product information">
                        <button type="button" 
                                data-tab="description" 
                                class="border-b-2 border-secondary text-secondary whitespace-nowrap py-4 px-1 text-sm font-medium">
                            Description
                        </button>
                        <?php if (!empty($product['dimensions'])): ?>
                            <button type="button" 
                                    data-tab="dimensions" 
                                    class="border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 text-sm font-medium">
                                Dimensions
                            </button>
                        <?php endif; ?>
                        <?php if (!empty($product['materials_description']) || !empty($product['care_instructions'])): ?>
                            <button type="button" 
                                    data-tab="materials" 
                                    class="border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 text-sm font-medium">
                                Materials & Care
                            </button>
                        <?php endif; ?>
                    </nav>
                </div>

                <!-- Tab Panels -->
                <div class="py-6">
                    <!-- Description -->
                    <div id="description-panel" class="tab-panel active">
                        <div class="prose prose-sm max-w-none text-gray-600">
                            <?= nl2br(htmlspecialchars($product['description'] ?? '')) ?>
                            
                            <?php if (!empty($product['features'])): ?>
                                <ul class="mt-4 space-y-2">
                                    <?php foreach ($product['features'] as $feature): ?>
                                        <li class="flex items-start">
                                            <svg class="h-5 w-5 text-secondary mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span><?= htmlspecialchars($feature) ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Dimensions -->
                    <?php if (!empty($product['dimensions'])): ?>
                        <div id="dimensions-panel" class="tab-panel hidden">
                            <div class="space-y-4">
                                <div class="aspect-w-1 aspect-h-1 w-full max-w-md">
                                    <img src="<?= $product['dimensions_image'] ?? '/path/to/default-dimensions.jpg' ?>" 
                                         alt="<?= htmlspecialchars($product['name']) ?> dimensions" 
                                         class="w-full h-full object-contain">
                                </div>
                                <dl class="grid grid-cols-2 gap-4">
                                    <?php foreach ($product['dimensions'] as $key => $value): ?>
                                        <div class="border-t border-gray-200 pt-2">
                                            <dt class="text-sm font-medium text-gray-500"><?= $key ?></dt>
                                            <dd class="mt-1 text-sm text-gray-900"><?= $value ?></dd>
                                        </div>
                                    <?php endforeach; ?>
                                </dl>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Materials & Care -->
                    <?php if (!empty($product['materials'])): ?>
                        <div id="materials-panel" class="tab-panel hidden">
                            <div class="space-y-6">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900 mb-2">Materials</h4>
                                    <p class="text-sm text-gray-600"><?= $product['materials_description'] ?? 'High-quality materials designed for durability and comfort.' ?></p>
                                    
                                    <?php if (!empty($product['care_instructions'])): ?>
                                        <div class="mt-4">
                                            <h4 class="text-sm font-medium text-gray-900 mb-2">Care Instructions</h4>
                                            <ul class="space-y-2 text-sm text-gray-600">
                                                <?php foreach ($product['care_instructions'] as $instruction): ?>
                                                    <li class="flex items-start">
                                                        <svg class="h-5 w-5 text-secondary mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        <span><?= htmlspecialchars($instruction) ?></span>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Related products -->
    <?php if (!empty($relatedProducts)): ?>
        <section aria-labelledby="related-heading" class="mt-16 border-t border-gray-200 py-12 px-4 sm:px-0">
            <div class="max-w-7xl mx-auto">
                <h2 id="related-heading" class="text-2xl font-bold text-gray-900 mb-8">You may also like</h2>

                <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    <?php foreach ($relatedProducts as $relatedProduct):
                        // Include the product card partial
                        $product = $relatedProduct; // Rename for the partial
                        include __DIR__ . '/partials/product_card.php';
                    ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
</div>
</div>

<script>
    // Image gallery functionality
    function changeImage(src, clickedElement) {
        if (!clickedElement) return;
        
        const mainImage = document.getElementById('main-image');
        if (mainImage) {
            // Add fade out effect
            mainImage.style.opacity = '0';
            
            // Wait for fade out to complete before changing image
            setTimeout(() => {
                mainImage.src = src;
                // Fade in the new image
                setTimeout(() => {
                    mainImage.style.opacity = '1';
                }, 50);
            }, 200);
        }
        
        // Update active thumbnail
        const thumbnails = document.querySelectorAll('[role="tab"]');
        thumbnails.forEach(thumb => {
            if (thumb === clickedElement) {
                thumb.classList.remove('border-transparent', 'hover:border-gray-200');
                thumb.classList.add('border-secondary');
            } else {
                thumb.classList.remove('border-secondary');
                thumb.classList.add('border-transparent', 'hover:border-gray-200');
            }
        });
    }

    // Quantity controls
    function updateQuantity(change) {
        const quantityInput = document.getElementById('quantity');
        if (!quantityInput) return;
        
        let newValue = parseInt(quantityInput.value) + change;
        if (newValue < 1) newValue = 1;
        if (newValue > 99) newValue = 99;
        quantityInput.value = newValue;
    }

    function incrementQuantity() {
        updateQuantity(1);
    }

    function decrementQuantity() {
        updateQuantity(-1);
    }

    // Tab functionality
    function setupTabs() {
        const tabs = document.querySelectorAll('[data-tab]');
        const panels = document.querySelectorAll('.tab-panel');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const tabId = tab.getAttribute('data-tab');
                
                // Update active tab
                tabs.forEach(t => {
                    if (t === tab) {
                        t.classList.add('border-secondary', 'text-secondary');
                        t.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                    } else {
                        t.classList.remove('border-secondary', 'text-secondary');
                        t.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                    }
                });
                
                // Show active panel
                panels.forEach(panel => {
                    if (panel.id === `${tabId}-panel`) {
                        panel.classList.remove('hidden');
                        panel.classList.add('active');
                    } else {
                        panel.classList.add('hidden');
                        panel.classList.remove('active');
                    }
                });
            });
        });
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize first thumbnail as active
        const firstThumbnail = document.querySelector('[role="tab"]');
        if (firstThumbnail) {
            firstThumbnail.classList.remove('border-transparent', 'hover:border-gray-200');
            firstThumbnail.classList.add('border-secondary');
        }
        
        // Initialize tabs
        setupTabs();
        
        // Keyboard navigation for thumbnails
        const thumbnails = document.querySelectorAll('[role="tab"]');
        thumbnails.forEach((thumb, index) => {
            thumb.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    const img = thumb.querySelector('img');
                    if (img) {
                        changeImage(img.src, thumb);
                    }
                } else if (e.key === 'ArrowRight') {
                    e.preventDefault();
                    const nextIndex = (index + 1) % thumbnails.length;
                    thumbnails[nextIndex].focus();
                } else if (e.key === 'ArrowLeft') {
                    e.preventDefault();
                    const prevIndex = (index - 1 + thumbnails.length) % thumbnails.length;
                    thumbnails[prevIndex].focus();
                }
            });
        });
    });
</script>
