<?php
$title = $title ?? 'Admin Products';
// Products data is now passed from the controller
?>

<div class="min-h-screen bg-[rgb(var(--color-background))]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-10 text-center sm:text-left">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-[rgb(var(--color-surface))] shadow-sm mb-4">
                <span class="h-2 w-2 rounded-full bg-[rgb(var(--color-accent))] mr-2"></span>
                <span class="text-sm font-medium text-[rgb(var(--color-primary))]">Admin Dashboard</span>
            </div>
            <h1 class="text-4xl font-bold text-[rgb(var(--color-primary))] tracking-tight">Product Management</h1>
            <p class="mt-3 text-lg text-[rgb(var(--color-primary-light))] max-w-2xl">Easily manage your product catalog and inventory in one place</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-[rgb(var(--color-surface))] rounded-xl shadow-sm p-6 border border-[rgb(var(--color-border))] hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-[rgba(var(--color-accent),0.1)] text-[rgb(var(--color-accent))]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-[rgb(var(--color-primary-light))]">Total Products</p>
                        <p class="text-2xl font-semibold text-[rgb(var(--color-primary))]"><?= count($products) ?></p>
                    </div>
                </div>
            </div>
            
            <div class="bg-[rgb(var(--color-surface))] rounded-xl shadow-sm p-6 border border-[rgb(var(--color-border))] hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-[rgba(var(--color-secondary),0.1)] text-[rgb(var(--color-secondary))]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-[rgb(var(--color-primary-light))]">Active Products</p>
                        <p class="text-2xl font-semibold text-[rgb(var(--color-primary))]"><?= count($products) ?></p>
                    </div>
                </div>
            </div>
            
            <div class="bg-[rgb(var(--color-surface))] rounded-xl shadow-sm p-6 border border-[rgb(var(--color-border))] hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-[rgba(var(--color-primary),0.1)] text-[rgb(var(--color-primary))]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-[rgb(var(--color-primary-light))]">Last Updated</p>
                        <p class="text-lg font-medium text-[rgb(var(--color-primary))]">Just now</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Bar -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div class="relative w-full sm:w-96">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-[rgb(var(--color-primary-light))]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" id="search" name="search" class="block w-full pl-10 pr-3 py-2.5 border border-[rgb(var(--color-border))] rounded-xl bg-[rgb(var(--color-surface))] shadow-sm focus:outline-none focus:ring-2 focus:ring-[rgb(var(--color-accent))] focus:border-[rgb(var(--color-accent))] text-sm text-[rgb(var(--color-primary))] placeholder-[rgba(var(--color-primary),0.5)]" placeholder="Search products...">
            </div>
            
            <div class="flex space-x-3 w-full sm:w-auto">
                <div class="relative">
                    <select id="category" name="category" class="appearance-none bg-[rgb(var(--color-surface))] border border-[rgb(var(--color-border))] rounded-xl pl-4 pr-10 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[rgb(var(--color-accent))] focus:border-[rgb(var(--color-accent))] text-[rgb(var(--color-primary))]">
                        <option>All Categories</option>
                        <?php 
                        $categories = array_unique(array_column($products, 'category'));
                        foreach ($categories as $category): 
                        ?>
                            <option><?= htmlspecialchars($category) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                        <svg class="h-4 w-4 text-[rgb(var(--color-primary))]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                
                <a href="/admin/products/add" class="inline-flex items-center px-5 py-2.5 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-[rgb(var(--color-accent))] hover:bg-[rgb(var(--color-accent-hover))] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[rgb(var(--color-accent))] transition-all duration-200 transform hover:-translate-y-0.5">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add Product
                </a>
            </div>
        </div>

        <!-- Products Grid -->
        <?php 
        // Include the products grid component
        $productsGridVars = [
            'products' => $products,
            'title' => 'Products',
            'subtitle' => 'Manage your products',
            'isAdmin' => true,
            'gridClasses' => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4'
        ];
        extract($productsGridVars);
        include __DIR__ . '/../components/products_grid.php';
        ?>
        
        <!-- Empty State with Add Product Button -->
        <?php if (empty($products)): ?>
            <div class="text-center py-16 bg-[rgb(var(--color-surface))] rounded-lg shadow border border-[rgb(var(--color-border))]">
                <svg class="mx-auto h-12 w-12 text-[rgb(var(--color-primary-light))]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-[rgb(var(--color-primary))]">No products</h3>
                <p class="mt-1 text-sm text-[rgb(var(--color-primary-light))]">Get started by creating a new product.</p>
                <div class="mt-6">
                    <a href="/admin/products/add" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-[rgb(var(--color-accent))] hover:bg-[rgb(var(--color-accent-hover))] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[rgb(var(--color-accent))] transition-colors">
                        <svg class="-ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        New Product
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>