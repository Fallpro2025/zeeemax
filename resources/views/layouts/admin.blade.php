<!DOCTYPE html>
<html lang="fr" x-data="{ darkMode: false }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Admin ZEEEMAX')</title>
    
    <!-- Preload ressources critiques -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" as="style">
    <link rel="preload" href="https://cdn.tailwindcss.com" as="script">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" as="script">
    
    <!-- Fonts optimisées -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    
    <!-- Alpine.js CDN avec defer -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Tailwind CSS CDN optimisé -->
    <script>
        // Configuration Tailwind commune
        window.tailwindConfig = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.3s ease-out',
                        'slide-up': 'slideUp 0.2s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        }
                    }
                }
            }
        };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = window.tailwindConfig;</script>
    
    <style>
        /* Cache CSS optimisé */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .glass-dark {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .hover-lift {
            transition: transform 0.15s ease;
        }
        .hover-lift:hover {
            transform: translateY(-2px);
        }
        
        /* Scrollbar optimisée */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { 
            background: rgba(139, 92, 246, 0.3);
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover { 
            background: rgba(139, 92, 246, 0.5);
        }
        
        /* Optimisations performance */
        * { 
            box-sizing: border-box;
        }
        img {
            loading: lazy;
            decoding: async;
        }
        
        /* Réduction des animations lourdes */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body class="font-sans bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-slate-900 dark:to-blue-900 transition-colors duration-200 min-h-screen">
    
    @yield('content')

    <!-- Messages toast réutilisables -->
    @if(session('success'))
        <div class="fixed top-4 right-4 z-50 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg animate-fade-in" 
             x-data="{ show: true }" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 4000)">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="ml-auto pl-3">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="fixed top-4 right-4 z-50 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-lg animate-fade-in"
             x-data="{ show: true }" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 4000)">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">{{ session('error') }}</p>
                </div>
                <button @click="show = false" class="ml-auto pl-3">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @stack('scripts')

    <!-- JavaScript commun optimisé -->
    <script>
        // Fonctions utilitaires pour toutes les pages admin
        window.adminUtils = {
            // Requête AJAX optimisée
            request: async function(url, options = {}) {
                const defaultOptions = {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                };
                
                try {
                    const response = await fetch(url, { ...defaultOptions, ...options });
                    return await response.json();
                } catch (error) {
                    console.error('Request failed:', error);
                    throw error;
                }
            },

            // Notification toast
            showToast: function(message, type = 'success') {
                const toast = document.createElement('div');
                toast.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg animate-fade-in ${type === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'}`;
                toast.innerHTML = `
                    <div class="flex">
                        <div class="ml-3">
                            <p class="text-sm font-medium">${message}</p>
                        </div>
                    </div>
                `;
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 3000);
            },

            // Debounce pour optimiser les recherches
            debounce: function(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }
        };

        // Performance monitoring
        if ('serviceWorker' in navigator && location.protocol === 'https:') {
            // Service worker pour cache (production only)
        }

        // Préchargement des pages importantes
        document.addEventListener('DOMContentLoaded', function() {
            const importantLinks = [
                '/admin/services',
                '/admin/portfolio', 
                '/admin/testimonials',
                '/admin/contacts'
            ];
            
            importantLinks.forEach(link => {
                const linkEl = document.createElement('link');
                linkEl.rel = 'prefetch';
                linkEl.href = link;
                document.head.appendChild(linkEl);
            });
        });
    </script>
</body>
</html>
