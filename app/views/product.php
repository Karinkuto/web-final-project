<div class="container mx-auto px-4 py-8 max-w-7xl">
    <!-- Breadcrumb -->
    <nav class="mb-8" aria-label="Breadcrumb">
        <ol class="product-breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="product-breadcrumb-separator">/</li>
            <li><a href="/products">Furniture</a></li>
            <?php if (!empty($product['category'])): ?>
                <li class="product-breadcrumb-separator">/</li>
                <li><a href="/products?category=<?= urlencode($product['category']) ?>"><?= htmlspecialchars($product['category']) ?></a></li>
            <?php endif; ?>
            <li class="product-breadcrumb-separator">/</li>
            <li class="product-breadcrumb-current"><?= htmlspecialchars($product['name']) ?></li>
        </ol>
    </nav>

    <div class="flex flex-col lg:flex-row gap-12">
        <!-- Image gallery -->
        <div class="product-gallery-container">
            <div class="product-gallery">
                <img id="main-image" 
                     src="<?= htmlspecialchars(is_array($product['image_url'] ?? '') ? $product['image_url'][0] : ($product['image_url'] ?? '/images/placeholder.jpg')) ?>" 
                     alt="<?= htmlspecialchars($product['name']) ?>" 
                     class="product-image"
                     loading="eager">
            </div>
            <?php if (count($product['images'] ?? []) > 1): ?>
                <div class="product-thumbnails">
                    <?php foreach ($product['images'] as $index => $image): ?>
                        <button type="button"
                            class="product-thumbnail-btn <?= $index === 0 ? 'border-secondary' : '' ?>"
                            onclick="changeImage('<?= htmlspecialchars($image) ?>', this)"
                            role="tab"
                            aria-selected="<?= $index === 0 ? 'true' : 'false' ?>"
                            tabindex="<?= $index === 0 ? '0' : '-1' ?>">
                            <img src="<?= htmlspecialchars($image) ?>" 
                                 alt="" 
                                 class="product-thumbnail-img">
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Product details -->
        <div class="product-details-container">
            <!-- Product Header -->
            <div class="product-header">
                <?php if (!empty($product['is_new'])): ?>
                    <span class="product-badge">New Arrival</span>
                <?php endif; ?>
                
                <h1 class="product-title"><?= htmlspecialchars($product['name']) ?></h1>
                
                <?php if (!empty($product['brand'])): ?>
                    <p class="product-brand">By <?= htmlspecialchars($product['brand']) ?></p>
                <?php endif; ?>
            </div>
            
            <!-- Price -->
            <div class="mb-6">
                <p class="product-price">$<?= number_format($product['price'], 2) ?></p>
                <?php if (isset($product['original_price']) && $product['original_price'] > $product['price']): ?>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="product-original-price">$<?= number_format($product['original_price'], 2) ?></span>
                        <span class="product-discount-badge">
                            Save <?= number_format((($product['original_price'] - $product['price']) / $product['original_price']) * 100, 0) ?>%
                        </span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <h3 class="variant-label">Description</h3>
                <div class="product-description">
                    <?= nl2br(htmlspecialchars($product['description'])) ?>
                </div>
            </div>

            <!-- Color Swatches -->
            <?php if (!empty($product['colors'])): ?>
                <div class="mt-6">
                    <h3 class="text-sm font-medium text-gray-900">Color</h3>
                    <fieldset class="mt-2">
                        <legend class="sr-only">Choose a color</legend>
                        <div class="flex items-center space-x-3">
                            <?php
                            $colors = is_string($product['colors'] ?? '') ? json_decode($product['colors'], true) : ($product['colors'] ?? []);
                            if (is_array($colors) && !empty($colors)) {
                                foreach ($colors as $index => $color): 
                                    $colorValue = is_array($color) ? ($color['value'] ?? '') : $color;
                                    $colorName = is_array($color) ? ($color['name'] ?? '') : $color;
                                    $isWhite = is_string($colorName) && (stripos($colorName, 'white') !== false || $colorValue === '#ffffff' || $colorValue === '#fff');
                            ?>
                                <label class="color-option relative -m-0.5 flex items-center justify-center rounded-full p-0.5 focus:outline-none">
                                    <input type="radio" 
                                           name="color-choice" 
                                           value="<?= htmlspecialchars($colorValue) ?>" 
                                           class="sr-only" 
                                           <?= $index === 0 ? 'checked' : '' ?> 
                                           aria-labelledby="color-choice-<?= $index ?>-label">
                                    <span id="color-choice-<?= $index ?>-label" class="sr-only">
                                        <?= htmlspecialchars($colorName) ?>
                                    </span>
                                    <span class="color-swatch <?= $isWhite ? 'color-swatch-white' : '' ?>" 
                                          style="background-color: <?= $colorValue ?>"
                                          aria-hidden="true"
                                          title="<?= htmlspecialchars($colorName) ?>">
                                    </span>
                                </label>
                            <?php 
                                endforeach;
                            }
                            ?>
                        </div>
                    </fieldset>
                </div>
            <?php endif; ?>

            <!-- Variants -->
            <?php if (!empty($product['materials']) || !empty($product['sizes'])): ?>
                <div class="product-variants">
                    <?php if (!empty($product['materials'])): ?>
                        <div>
                            <h3 class="variant-label">Material</h3>
                            <div class="variant-options">
                                <?php foreach ($product['materials'] as $material): ?>
                                    <label class="material-option">
                                        <input type="radio" 
                                               name="material" 
                                               value="<?= htmlspecialchars($material['value']) ?>" 
                                               class="sr-only" 
                                               <?= $material === ($product['materials'][0] ?? null) ? 'checked' : '' ?>>
                                        <span class="material-label">
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
                                <h3 class="variant-label">Size</h3>
                                <a href="#" class="size-guide-link">Size guide</a>
                            </div>
                            <div class="grid grid-cols-4 gap-3">
                                <?php foreach ($product['sizes'] as $size): ?>
                                    <label class="size-option">
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
                <label for="quantity" class="variant-label">Quantity</label>
                <div class="quantity-selector mt-1">
                    <button type="button" 
                            onclick="decrementQuantity()" 
                            class="quantity-btn"
                            aria-label="Decrease quantity">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                    </button>
                    <input type="number" 
                           id="quantity" 
                           name="quantity" 
                           min="1" 
                           value="1" 
                           class="quantity-input">
                    <button type="button" 
                            onclick="incrementQuantity()" 
                            class="quantity-btn"
                            aria-label="Increase quantity">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Add to cart -->
            <div class="mt-8">
                <button type="submit" class="btn btn-primary w-full">
                    Add to bag
                </button>
            </div>

            <!-- Product Information Tabs -->
            <div class="product-tabs mt-12 border-t border-gray-200 pt-6">
                <div class="product-tabs-nav flex border-b border-gray-200 mb-6" role="tablist" aria-label="Product information">
                    <button type="button" 
                            role="tab"
                            id="description-tab"
                            aria-controls="description-panel"
                            aria-selected="true"
                            data-tab-target="description-panel"
                            class="product-tab-btn border-b-2 border-transparent py-4 px-6 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none active"
                            onclick="switchTab('description-panel', this)">
                        Description
                    </button>
                    <?php if (!empty($product['materials']) || !empty($product['dimensions'])): ?>
                        <button type="button" 
                                role="tab"
                                id="specs-tab"
                                aria-controls="specs-panel"
                                aria-selected="false"
                                data-tab-target="specs-panel"
                                class="product-tab-btn border-b-2 border-transparent py-4 px-6 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none"
                                onclick="switchTab('specs-panel', this)">
                            Specifications
                        </button>
                    <?php endif; ?>
                    <?php if (!empty($product['dimensions'])): ?>
                        <button type="button" 
                                role="tab"
                                id="dimensions-tab"
                                aria-controls="dimensions-panel"
                                aria-selected="false"
                                class="product-tab-btn">
                            Dimensions
                        </button>
                    <?php endif; ?>
                    <?php if (!empty($product['materials_description']) || !empty($product['care_instructions'])): ?>
                        <button type="button" 
                                role="tab"
                                id="materials-tab"
                                aria-controls="materials-panel"
                                aria-selected="false"
                                class="product-tab-btn">
                            Materials & Care
                        </button>
                    <?php endif; ?>
                </div>
                <div class="product-tab-panels">
                    <!-- Description -->
                    <div id="description-panel" 
                         role="tabpanel"
                         aria-labelledby="description-tab"
                         class="product-tab-panel active py-6">
                        <div class="prose prose-sm max-w-none product-description">
                            <?= nl2br(htmlspecialchars($product['description'] ?? '')) ?>
                        </div>
                    </div>

                    <!-- Specifications -->
                    <div id="specs-panel" 
                         role="tabpanel"
                         aria-labelledby="specs-tab"
                         class="product-tab-panel py-6"
                         style="display: none;">
                        <?php if (!empty($product['materials'])): ?>
                            <div class="mb-6">
                                <h4 class="text-lg font-medium mb-2">Materials</h4>
                                <p class="text-gray-700">
                                    <?php 
                                    $materials = is_string($product['materials']) ? json_decode($product['materials'], true) : $product['materials'];
                                    if (is_array($materials) && isset($materials[0]['name'])) {
                                        echo htmlspecialchars(implode(', ', array_column($materials, 'name')));
                                    } else if (is_array($materials)) {
                                        echo htmlspecialchars(implode(', ', $materials));
                                    } else {
                                        echo htmlspecialchars($materials);
                                    }
                                    ?>
                                </p>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($product['dimensions'])): ?>
                            <div class="mb-6">
                                <h4 class="text-lg font-medium mb-2">Dimensions</h4>
                                <p class="text-gray-700"><?= htmlspecialchars($product['dimensions']) ?></p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Dimensions -->
                    <?php if (!empty($product['dimensions'])): ?>
                        <div id="dimensions-panel" 
                             role="tabpanel"
                             aria-labelledby="dimensions-tab"
                             class="product-tab-panel">
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
                    <?php if (!empty($product['materials_description']) || !empty($product['care_instructions'])): ?>
                        <div id="materials-panel" 
                             role="tabpanel"
                             aria-labelledby="materials-tab"
                             class="product-tab-panel">
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
        <section aria-labelledby="related-heading" class="related-products">
            <h2 id="related-heading" class="related-products-title mb-8">You may also like</h2>
            <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                <?php foreach ($relatedProducts as $relatedProduct):
                    // Include the product card partial
                    $product = $relatedProduct; // Rename for the partial
                    include __DIR__ . '/partials/product_card.php';
                ?>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
</div>
</div>

<script>
    // Image gallery functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the first thumbnail as active
        const firstThumbnail = document.querySelector('[data-thumbnail]');
        if (firstThumbnail) {
            firstThumbnail.classList.add('ring-2', 'ring-primary', 'ring-offset-2');
        }
    });
    
    function changeMainImage(src, thumbnail) {
        // Update main image
        const mainImage = document.getElementById('main-product-image');
        if (mainImage) {
            mainImage.style.opacity = '0';
            setTimeout(() => {
                mainImage.src = src;
                mainImage.style.opacity = '1';
            }, 150);
        }
        
        // Update active thumbnail
        document.querySelectorAll('[data-thumbnail]').forEach(thumb => {
            thumb.classList.remove('ring-2', 'ring-primary', 'ring-offset-2');
        });
        
        if (thumbnail) {
            thumbnail.classList.add('ring-2', 'ring-primary', 'ring-offset-2');
        }
    }
    
    // Initialize first tab as active
    document.addEventListener('DOMContentLoaded', function() {
        switchTab('description-panel', document.querySelector('.product-tab-btn'));
    });

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
        const thumbnails = document.querySelectorAll('.product-thumbnail-btn');
        thumbnails.forEach(thumb => {
            if (thumb === clickedElement) {
                thumb.classList.add('border-secondary');
                thumb.setAttribute('aria-selected', 'true');
            } else {
                thumb.classList.remove('border-secondary');
                thumb.setAttribute('aria-selected', 'false');
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
        const tabs = document.querySelectorAll('.product-tab-btn');
        const panels = document.querySelectorAll('.product-tab-panel');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const panelId = tab.getAttribute('aria-controls');
                const panel = document.getElementById(panelId);
                
                if (!panel) return;
                
                // Update active tab
                tabs.forEach(t => {
                    t.classList.remove('active');
                    t.setAttribute('aria-selected', 'false');
                });
                
                tab.classList.add('active');
                tab.setAttribute('aria-selected', 'true');
                
                // Show active panel
                panels.forEach(p => {
                    p.classList.remove('active');
                });
                
                panel.classList.add('active');
            });
        });
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize first thumbnail as active if not already set
        const thumbnails = document.querySelectorAll('.product-thumbnail-btn');
        if (thumbnails.length > 0) {
            const activeThumbnail = document.querySelector('.product-thumbnail-btn[aria-selected="true"]');
            if (!activeThumbnail) {
                thumbnails[0].classList.add('border-secondary');
                thumbnails[0].setAttribute('aria-selected', 'true');
            }
        }
        
        // Initialize tabs
        setupTabs();
        
        // Keyboard navigation for thumbnails
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
