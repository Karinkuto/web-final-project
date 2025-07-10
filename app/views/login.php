<?php
$title = $title ?? 'Login';
?>
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-10">
        <h2 class="text-center text-3xl font-bold text-gray-900 mb-8">Sign in to your account</h2>
        <?php if (!empty($error)): ?>
            <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg text-sm text-center">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form class="space-y-6" action="/login" method="POST" autocomplete="off">
            <div class="space-y-4">
                <div>
                    <label for="email-address" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                    <input id="email-address" name="email" type="email" autocomplete="email" required class="block w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary sm:text-sm" placeholder="you@example.com">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary sm:text-sm" placeholder="••••••••">
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me" name="remember" type="checkbox" class="h-4 w-4 text-secondary focus:ring-secondary border-gray-300 rounded">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                </div>
                <div class="text-sm">
                    <a href="#" class="font-medium text-secondary hover:text-secondary/80 transition-colors">Forgot your password?</a>
                </div>
            </div>
            <div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-lg text-white bg-secondary hover:bg-secondary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary/50 transition-colors">
                    Sign in
                </button>
            </div>
        </form>
    </div>
</div> 