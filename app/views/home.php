<!-- Hero Section -->
<section class="relative h-[500px] md:h-[600px] lg:h-[700px] overflow-hidden rounded-2xl my-6 md:my-8">
    <!-- Background Image with Gradient Overlays -->
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1556911220-e15b29be8c8f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2940&q=80"
            alt="Modern living room with grey sofa and coffee table"
            class="w-full h-full object-cover">
        <!-- Bottom gradient -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
        <!-- Top gradient (shorter) -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 to-transparent h-40"></div>
    </div>

    <!-- Shop Now Button (Top Right) -->
    <div class="relative pt-6 pr-6 md:pt-8 md:pr-8">
        <div class="flex justify-end">
            <a href="/shop" class="inline-flex items-center justify-center px-8 py-3.5 rounded-md font-medium text-white bg-accent hover:bg-accent-hover transition-colors">
                Shop Now
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="relative h-full flex items-center">
        <div class="max-w-4xl px-6 sm:px-8 md:px-12 lg:px-16">
            <h1 class="text-5xl md:text-6xl lg:text-7xl xl:text-8xl 2xl:text-9xl font-bold text-white mb-2 leading-[0.95]">
                Elevate<br>Your Space
            </h1>
            <p class="text-lg md:text-xl text-white/90 max-w-2xl mt-6">
                Discover curated collections of furniture and decor to transform your home.
            </p>
        </div>
    </div>
</section>

<!-- Featured Collections Section -->
<section class="py-12 md:py-16">
    <?php
    $collections = $featuredCollections;
    $title = 'Shop by Collection';
    $viewAllUrl = '/collections';
    include __DIR__ . '/components/collections_grid.php';
    unset($collections, $title, $viewAllUrl);
    ?>
</section>

<!-- New Arrivals Section -->
<section class="py-12 md:py-16">
    <?php
    $products = $newArrivals;
    $title = 'New Arrivals';
    $subtitle = 'Discover our latest additions';
    $viewAllUrl = '/new-arrivals';
    include __DIR__ . '/components/products_grid.php';
    unset($products, $title, $subtitle, $viewAllUrl);
    ?>
</section>

<!-- CTA Section -->
<section class="py-12 md:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6 text-primary">Ready to Transform Your Space?</h2>
        <p class="text-lg text-primary/80 mb-8 max-w-2xl mx-auto">
            Join our community of design enthusiasts and get exclusive access to new arrivals, special offers, and design inspiration.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4 max-w-md mx-auto">
            <a href="/signup" class="px-8 py-3.5 bg-accent hover:bg-accent-hover text-white font-medium rounded-lg text-center transition-colors">
                Sign Up for Free
            </a>
            <a href="/shop" class="px-8 py-3.5 bg-transparent border border-primary/20 hover:border-primary/40 text-primary font-medium rounded-lg text-center transition-colors">
                Shop Now
            </a>
        </div>
    </div>
</section>
