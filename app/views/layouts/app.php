<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'My App') ?></title>

    <!-- Preload Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- CSS -->
    <link href="/css/app.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: 'rgb(var(--color-primary) / <alpha-value>)',
                        'primary-light': 'rgb(var(--color-primary-light) / <alpha-value>)',
                        accent: 'rgb(var(--color-accent) / <alpha-value>)',
                        'accent-hover': 'rgb(var(--color-accent-hover) / <alpha-value>)',
                        secondary: 'rgb(var(--color-secondary) / <alpha-value>)',
                        background: 'rgb(var(--color-background) / <alpha-value>)',
                        surface: 'rgb(var(--color-surface) / <alpha-value>)',
                        border: 'rgb(var(--color-border) / <alpha-value>)',
                    },
                    fontFamily: {
                        sans: ['Inter', 'Noto Sans', 'sans-serif'],
                        mono: ['ui-monospace', 'SFMono-Regular', 'Menlo', 'Monaco', 'Consolas', 'Liberation Mono', 'Courier New', 'monospace'],
                    },
                    spacing: {
                        'xs': 'var(--spacing-xs)',
                        'sm': 'var(--spacing-sm)',
                        'md': 'var(--spacing-md)',
                        'lg': 'var(--spacing-lg)',
                        'xl': 'var(--spacing-xl)',
                        '2xl': 'var(--spacing-2xl)',
                    },
                    borderRadius: {
                        'sm': 'var(--radius-sm)',
                        'md': 'var(--radius-md)',
                        'lg': 'var(--radius-lg)',
                        'xl': 'var(--radius-xl)',
                        'full': 'var(--radius-full)',
                    },
                },
            },
        }
    </script>
</head>

<body class="min-h-screen bg-background text-primary">
    <!-- Header -->
    <header class="bg-background border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/" class="text-2xl font-bold text-gray-900">Lumina</a>
                </div>

                <!-- Navigation Links -->
                <nav class="hidden md:flex items-center space-x-8 ml-12">
                    <a href="/" class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium">Home</a>
                    <a href="/products" class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium">Products</a>
                </nav>

                <!-- Icons -->
                <div class="flex items-center space-x-4 ml-auto">
                    <button type="button" class="p-2 rounded-md bg-secondary/10 text-secondary hover:bg-secondary/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary/30 transition-colors">
                        <span class="sr-only">Search</span>
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                    <button type="button" class="p-2 rounded-md bg-secondary/10 text-secondary hover:bg-secondary/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary/30 transition-colors">
                        <span class="sr-only">User account</span>
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </button>
                    <a href="/cart" class="p-2 rounded-md bg-secondary/10 text-secondary hover:bg-secondary/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary/30 relative transition-colors">
                        <span class="sr-only">Shopping cart</span>
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">0</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <?= $content ?>
    </main>

    <!-- Footer -->
    <footer class="flex justify-center mt-12">
        <div class="flex max-w-[960px] flex-1 flex-col">
            <div class="flex flex-col gap-6 px-5 py-10 text-center @container">
                <div class="flex flex-wrap items-center justify-center gap-6 @[480px]:flex-row @[480px]:justify-around">
                    <a class="text-secondary text-base font-normal leading-normal min-w-40 hover:opacity-80 transition-opacity" href="#">Contact Us</a>
                    <a class="text-secondary text-base font-normal leading-normal min-w-40 hover:opacity-80 transition-opacity" href="#">FAQ</a>
                    <a class="text-secondary text-base font-normal leading-normal min-w-40 hover:opacity-80 transition-opacity" href="#">Shipping & Returns</a>
                    <a class="text-secondary text-base font-normal leading-normal min-w-40 hover:opacity-80 transition-opacity" href="#">Privacy Policy</a>
                </div>
                <div class="flex flex-wrap justify-center gap-6">
                    <a href="#" class="text-secondary hover:opacity-80 transition-opacity" aria-label="Twitter">
                        <i class="fab fa-twitter text-2xl"></i>
                    </a>
                    <a href="#" class="text-secondary hover:opacity-80 transition-opacity" aria-label="Instagram">
                        <i class="fab fa-instagram text-2xl"></i>
                    </a>
                    <a href="#" class="text-secondary hover:opacity-80 transition-opacity" aria-label="Pinterest">
                        <i class="fab fa-pinterest text-2xl"></i>
                    </a>
                </div>
                <p class="text-secondary text-base font-normal leading-normal">&copy; <?= date('Y') ?> Lumina. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Alpine.js or other JS can go here -->
    <script>
        // Enable smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>

</html>
