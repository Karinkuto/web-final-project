<?php
$title = $title ?? 'Manage Products';
?>
<div class="min-h-screen flex flex-col items-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-5xl bg-white rounded-2xl shadow-xl p-10">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Products</h2>
            <a href="/admin/products/add" class="px-5 py-2 bg-secondary text-white rounded-lg font-semibold hover:bg-secondary/90 transition-colors">Add Product</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900"><?= htmlspecialchars($product['name']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">$<?= number_format($product['price'], 2) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700"><?= htmlspecialchars($product['category'] ?? '-') ?></td>
                            <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                                <a href="/admin/products/edit/<?= (int)$product['id'] ?>" class="text-blue-600 hover:underline">Edit</a>
                                <form action="/admin/products/delete/<?= (int)$product['id'] ?>" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    <button type="submit" class="text-red-600 hover:underline bg-transparent border-0 p-0 m-0 cursor-pointer">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 