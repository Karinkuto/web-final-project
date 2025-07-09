<div class="container mx-auto px-4 py-8 max-w-6xl">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-2 text-sm">
            <li class="text-gray-500">Shopping Bag</li>
            <li class="text-gray-300">/</li>
            <li class="text-gray-500">Review</li>
        </ol>
    </nav>

    <h1 class="text-3xl font-bold mb-8">Shopping Bag</h1>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Cart Items -->
        <div class="lg:w-2/3">
            <?php if (!empty($cartItems)): ?>
                <div class="space-y-6">
                    <?php foreach ($cartItems as $item): ?>
                        <div class="flex flex-col sm:flex-row border-b border-gray-200 pb-6">
                            <!-- Product Image -->
                            <div class="w-full sm:w-32 h-32 bg-gray-100 rounded-lg overflow-hidden mb-4 sm:mb-0 sm:mr-6">
                                <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="w-full h-full object-cover">
                            </div>

                            <!-- Product Details -->
                            <div class="flex-1">
                                <div class="flex justify-between">
                                    <div>
                                        <h3 class="text-lg font-medium"><?= htmlspecialchars($item['name']) ?></h3>
                                        <p class="text-gray-500"><?= htmlspecialchars($item['color']) ?></p>
                                        <p class="text-gray-500 text-sm mt-1">Size: <?= htmlspecialchars($item['size']) ?></p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-semibold text-gray-900">$<?= number_format($item['price'], 2) ?></p>
                                        <button class="text-sm text-gray-500 hover:text-red-600 mt-1 transition-colors">Remove</button>
                                    </div>
                                </div>

                                <!-- Quantity Selector -->
                                <div class="mt-4 flex items-center">
                                    <button type="button" onclick="updateQuantity(<?= $item['id'] ?>, -1)" class="p-1.5 rounded-md bg-secondary/10 text-secondary hover:bg-secondary/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary/30 transition-colors">
                                        <span class="sr-only">Decrease quantity</span>
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                        </svg>
                                    </button>
                                    <span class="mx-3 w-6 text-center font-medium quantity" data-item-id="<?= $item['id'] ?>"><?= $item['quantity'] ?></span>
                                    <button type="button" onclick="updateQuantity(<?= $item['id'] ?>, 1)" class="p-1.5 rounded-md bg-secondary/10 text-secondary hover:bg-secondary/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary/30 transition-colors">
                                        <span class="sr-only">Increase quantity</span>
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <p class="text-gray-500 mb-4">Your cart is empty</p>
                    <a href="/products" class="inline-block bg-secondary text-white px-6 py-2 rounded-md hover:bg-secondary/90 transition-colors">
                        Continue Shopping
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Order Summary -->
        <div class="lg:w-1/3 space-y-6">
            <!-- Order Summary Card -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-4 border-b border-gray-100">Order Summary</h2>

                <div class="space-y-4">
                    <div class="flex justify-between text-gray-700">
                        <span>Subtotal</span>
                        <span class="font-medium text-gray-900 subtotal-amount">$<?= number_format($subtotal, 2) ?></span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Shipping</span>
                        <span class="font-medium text-gray-900 shipping-amount"><?= $shipping === 0 ? 'Free' : '$' . number_format($shipping, 2) ?></span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Estimated Tax</span>
                        <span class="font-medium text-gray-900 tax-amount">$<?= number_format($estimatedTax, 2) ?></span>
                    </div>

                    <div class="border-t border-gray-200 pt-4 mt-4">
                        <div class="flex justify-between text-lg font-semibold text-gray-900">
                            <span>Total</span>
                            <span class="total-amount">$<?= number_format($total, 2) ?></span>
                        </div>
                    </div>
                </div>

                <button class="w-full bg-red-600 hover:bg-red-700 text-white py-3.5 rounded-lg font-medium transition-all duration-200 transform hover:-translate-y-0.5 mt-8 text-base">
                    Proceed to Checkout
                </button>

                <p class="text-center text-sm text-gray-500 mt-4">
                    or <a href="/products" class="text-secondary hover:underline font-medium">Continue Shopping</a>
                </p>
            </div>

            <!-- Shipping Info Card -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-start">
                    <div class="flex-shrink-0 text-green-500 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-900">Free Shipping</h3>
                        <p class="text-sm text-gray-500 mt-1">Enjoy free shipping on all orders over $50</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Function to update item quantity
function updateQuantity(itemId, change) {
    // In a real app, this would make an AJAX call to update the cart
    // For now, we'll just update the UI
    const quantityElement = document.querySelector(`[data-item-id="${itemId}"] .quantity`);
    if (!quantityElement) return;

    let newQuantity = parseInt(quantityElement.textContent) + change;
    if (newQuantity < 1) newQuantity = 1; // Don't go below 1

    quantityElement.textContent = newQuantity;

    // Update the cart total (simplified version - in a real app, this would be calculated server-side)
    updateCartTotals();
}

// Function to update cart totals (simplified version)
function updateCartTotals() {
    // In a real app, this would make an AJAX call to get updated totals
    // For now, we'll just update the UI with the existing values
    const subtotal = <?= $subtotal ?>;
    const shipping = <?= $shipping ?>;
    const estimatedTax = <?= $estimatedTax ?>;
    const total = <?= $total ?>;

    document.querySelector('.subtotal-amount').textContent = '$' + subtotal.toFixed(2);
    document.querySelector('.shipping-amount').textContent = shipping === 0 ? 'Free' : '$' + shipping.toFixed(2);
    document.querySelector('.tax-amount').textContent = '$' + estimatedTax.toFixed(2);
    document.querySelector('.total-amount').textContent = '$' + total.toFixed(2);
}

// Add event listeners when the DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Add any additional event listeners here
});
</script>
