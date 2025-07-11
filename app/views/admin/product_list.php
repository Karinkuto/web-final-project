<?php
$title = $title ?? 'Product List';
?>

<div class="min-h-screen bg-[rgb(var(--color-background))]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-10 text-center sm:text-left">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-[rgb(var(--color-surface))] shadow-sm mb-4">
                <span class="h-2 w-2 rounded-full bg-[rgb(var(--color-accent))] mr-2"></span>
                <span class="text-sm font-medium text-[rgb(var(--color-primary))]">Admin Dashboard</span>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-[rgb(var(--color-primary))] tracking-tight">Product List</h1>
                    <p class="mt-3 text-lg text-[rgb(var(--color-primary-light))] max-w-2xl">Manage all your products in one place</p>
                </div>
                <a href="/admin/products/add" class="inline-flex items-center px-5 py-2.5 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-[rgb(var(--color-accent))] hover:bg-[rgb(var(--color-accent-hover))] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[rgb(var(--color-accent))] transition-all duration-200 transform hover:-translate-y-0.5">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add Product
                </a>
            </div>
        </div>

        <?php 
        // Include the products grid component with the same configuration as the dashboard
        $productsGridVars = [
            'products' => $products,
            'title' => 'All Products',
            'subtitle' => 'Manage your product catalog',
            'isAdmin' => true,
            'gridClasses' => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4'
        ];
        extract($productsGridVars);
        include __DIR__ . '/../components/products_grid.php';
        ?>
    </div>
</div>
