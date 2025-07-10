<?php
$title = $title ?? 'Admin Dashboard';
?>
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl p-10">
        <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Admin Dashboard</h2>
        <p class="text-center text-gray-600 mb-8">Welcome, Admin! Use the links below to manage products.</p>
        <div class="flex flex-col sm:flex-row gap-6 justify-center">
            <a href="/admin/products" class="w-full sm:w-auto px-6 py-3 bg-secondary text-white rounded-lg font-semibold text-center hover:bg-secondary/90 transition-colors">Manage Products</a>
            <a href="/admin/products/add" class="w-full sm:w-auto px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold text-center hover:bg-gray-800 transition-colors">Add Product</a>
        </div>
    </div>
</div> 