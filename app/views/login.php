<?php
$title = $title ?? 'Login';
?>
<div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md space-y-8">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">Sign in to your account</h2>
            <p class="mt-2 text-sm text-gray-600">Enter your credentials to access your account</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="p-4 rounded-lg bg-red-50 border border-red-200 text-red-600 text-sm text-center">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form class="mt-8 space-y-6" action="/login" method="POST" autocomplete="off">
            <div class="space-y-4">
                <div>
                    <label for="email-address" class="block text-sm font-medium text-gray-700 mb-2">Email address</label>
                    <div class="relative">
                        <input id="email-address" 
                               name="email" 
                               type="email" 
                               autocomplete="email" 
                               required 
                               class="form-input" 
                               placeholder="you@example.com">
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <input id="password" 
                               name="password" 
                               type="password" 
                               autocomplete="current-password" 
                               required 
                               class="form-input" 
                               placeholder="••••••••">
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="btn btn-primary w-full">
                    Sign in
                </button>
            </div>
        </form>

        <div class="text-center text-sm text-gray-500">
            Don't have an account?
            <a href="/signup" class="font-medium text-accent hover:text-accent-hover">
                Sign up
            </a>
        </div>
    </div>
</div>
