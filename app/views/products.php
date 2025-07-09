<div class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Shop All</h1>
            <p class="mt-2 text-sm text-gray-600">Browse our premium collection of clothing and accessories</p>
        </div>

        <!-- Filters -->
        <div class="mb-8 border-b border-gray-200 pb-5">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <!-- Category Tabs -->
                <div class="flex space-x-4 overflow-x-auto pb-2 scrollbar-hide">
                    <a href="?" 
                       class="whitespace-nowrap px-4 py-2 text-sm font-medium rounded-md transition-colors <?= !$active_category ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-100' ?>">
                        All Products
                    </a>
                    <?php foreach ($categories as $category): ?>
                        <a href="?category=<?= urlencode($category) ?>" 
                           class="whitespace-nowrap px-4 py-2 text-sm font-medium rounded-md transition-colors <?= $active_category === $category ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-100' ?>">
                            <?= htmlspecialchars($category) ?>
                        </a>
                    <?php endforeach; ?>
                </div>

                <!-- Sort Dropdown -->
                <div class="mt-4 sm:mt-0">
                    <label for="sort" class="sr-only">Sort</label>
                    <select id="sort" name="sort" 
                            onchange="window.location.href = '?sort=' + this.value + '<?= $active_category ? '&category=' . urlencode($active_category) : '' ?>'"
                            class="block w-full rounded-md border border-gray-300 py-2 pl-3 pr-10 text-base focus:border-secondary focus:outline-none focus:ring-secondary sm:text-sm">
                        <option value="featured" <?= $sort_by === 'featured' ? 'selected' : '' ?>>Featured</option>
                        <option value="newest" <?= $sort_by === 'newest' ? 'selected' : '' ?>>Newest</option>
                        <option value="price_asc" <?= $sort_by === 'price_asc' ? 'selected' : '' ?>>Price: Low to High</option>
                        <option value="price_desc" <?= $sort_by === 'price_desc' ? 'selected' : '' ?>>Price: High to Low</option>
                        <option value="top_rated" <?= $sort_by === 'top_rated' ? 'selected' : '' ?>>Top Rated</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php 
            // Filter products by category if selected
            $filteredProducts = $active_category 
                ? array_filter($products, fn($p) => $p['category'] === $active_category) 
                : $products;

            // Sort products based on selection
            usort($filteredProducts, function($a, $b) use ($sort_by) {
                switch ($sort_by) {
                    case 'newest':
                        return ($b['is_new'] ?? false) <=> ($a['is_new'] ?? false);
                    case 'price_asc':
                        return $a['price'] <=> $b['price'];
                    case 'price_desc':
                        return $b['price'] <=> $a['price'];
                    case 'top_rated':
                        return $b['rating'] <=> $a['rating'];
                    case 'featured':
                    default:
                        return 0; // Keep original order
                }
            });

            // Display products
            foreach ($filteredProducts as $product): 
                include __DIR__ . '/partials/product_card.php';
            endforeach; 
            ?>
        </div>

        <!-- Empty State -->
        <?php if (empty($filteredProducts)): ?>
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No products found</h3>
                <p class="mt-1 text-sm text-gray-500">We couldn't find any products matching your selection.</p>
                <div class="mt-6">
                    <a href="?" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-secondary hover:bg-secondary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary">
                        Clear all filters
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Mobile filter dialog (simplified for brevity) -->
<div x-data="{ mobileFiltersOpen: false }" class="lg:hidden">
    <!-- Mobile filter dialog toggle -->
    <div class="fixed inset-x-0 bottom-0 z-40 flex justify-between bg-white border-t border-gray-200 p-4 lg:hidden">
        <button type="button" @click="mobileFiltersOpen = true" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
            <svg class="mr-2 h-5 w-5 flex-shrink-0 text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
            </svg>
            Filters
        </button>
        <button type="button" class="text-sm font-medium text-gray-700 hover:text-gray-900">
            Sort
        </button>
    </div>

    <!-- Mobile filter dialog -->
    <div x-show="mobileFiltersOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto bg-white p-4 lg:hidden">
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <h2 class="text-lg font-medium text-gray-900">Filters</h2>
            <button type="button" @click="mobileFiltersOpen = false" class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400">
                <span class="sr-only">Close menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <!-- Mobile filter content would go here -->
    </div>
</div>

<script>
// Simple client-side filtering for better UX
// This is a basic implementation and can be enhanced further
document.addEventListener('DOMContentLoaded', function() {
    // Add any client-side interactivity here
    // For example, you could add AJAX-based filtering
});
</script>
