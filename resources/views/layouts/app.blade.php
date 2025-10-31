<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'ZEEEMAX - Brand Empowerment')</title>
    
    <!-- Preload ressources critiques -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" as="style">
    <link rel="preload" href="https://cdn.tailwindcss.com" as="script">
    
    <!-- Fonts optimisées -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet"></noscript>
    
    <!-- Tailwind CSS CDN optimisé -->
    <script>
        // Configuration Tailwind optimisée
        window.tailwindConfig = {
            theme: {
                extend: {
                    fontFamily: {
                        raleway: ['Raleway', 'sans-serif'],
                        sans: ['Raleway', 'sans-serif'],
                    },
                    colors: {
                        primary: '#8B5CF6',
                        secondary: '#EC4899',
                        accent: '#F59E0B',
                    },
                    animation: {
                        'fade-in-up': 'fade-in-up 0.4s ease-out forwards',
                        'blob': 'blob 4s infinite',
                        'float': 'float 2s ease-in-out infinite',
                        'pulse-glow': 'pulse-glow 1.5s ease-in-out infinite',
                    },
                    keyframes: {
                        'fade-in-up': {
                            '0%': { 
                                opacity: '0',
                                transform: 'translateY(20px)'
                            },
                            '100%': { 
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        },
                        'blob': {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' }
                        },
                        'float': {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-5px)' }
                        },
                        'pulse-glow': {
                            '0%, 100%': { opacity: '1' },
                            '50%': { opacity: '0.5' }
                        }
                    }
                }
            }
        };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = window.tailwindConfig;</script>
    
    @php
        $siteName = $siteSettings->nom_site ?? 'ZEEEMAX';
        $siteDescription = $siteSettings->description_site ?? 'ZEEEMAX accompagne les entrepreneurs à révéler leur identité de marque avec un branding sur-mesure et une stratégie digitale impactante.';
        $currentUrl = url()->current();
        $defaultOgImage = $siteSettings->logo_url ?? asset('images/logo-footer.png');
        if (!str_starts_with($defaultOgImage, 'http')) {
            $defaultOgImage = url($defaultOgImage);
        }
        $defaultOgImage = str_replace(' ', '%20', $defaultOgImage);
    @endphp
    
    @php
        $pageTitle = $siteName . ' - Brand Empowerment';
        $pageDescription = $siteDescription;
        $pageOgImage = $defaultOgImage;
    @endphp
    
    <!-- Meta SEO de base -->
    @php
        use Illuminate\Support\Facades\View;
        $seoDescription = View::hasSection('description') ? View::yieldContent('description') : $pageDescription;
        $seoTitle = View::hasSection('title') ? View::yieldContent('title') : $pageTitle;
        $seoOgImage = View::hasSection('og:image') ? View::yieldContent('og:image') : $pageOgImage;
    @endphp
    <meta name="description" content="{{ Str::limit(strip_tags($seoDescription), 160) }}">
    <meta name="keywords" content="@yield('keywords', 'branding, identité de marque, stratégie digitale, entrepreneur, communication, marketing digital, création de marque')">
    <meta name="author" content="{{ $siteName }}">
    <meta name="robots" content="@yield('robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1')">
    <meta name="googlebot" content="index, follow">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $currentUrl }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og:type', 'website')">
    <meta property="og:url" content="{{ $currentUrl }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($seoDescription), 200) }}">
    <meta property="og:image" content="{{ $seoOgImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $seoTitle }}">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:locale" content="fr_FR">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $currentUrl }}">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($seoDescription), 200) }}">
    <meta name="twitter:image" content="{{ $seoOgImage }}">
    <meta name="twitter:image:alt" content="{{ $seoTitle }}">
    @if(!empty($siteSettings->twitter))
        <meta name="twitter:site" content="{{ '@' . str_replace('@', '', $siteSettings->twitter) }}">
    @endif
    
    <!-- Favicon -->
    @php($faviconUrl = $siteSettings->logo_url ?? 'images/logo-footer.PNG')
    <link rel="icon" type="image/png" href="{{ str_starts_with($faviconUrl, 'http') ? $faviconUrl : asset($faviconUrl) }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ str_starts_with($faviconUrl, 'http') ? $faviconUrl : asset($faviconUrl) }}">
    
    <!-- Sitemap -->
    <link rel="sitemap" type="application/xml" href="{{ url('/sitemap.xml') }}">
    
    <!-- Schema.org JSON-LD -->
    @php
        $schemaData = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $siteName,
            'url' => url('/'),
            'logo' => url($siteSettings->logo_url ?? 'images/logo-footer.png'),
            'description' => $siteDescription
        ];
        
        if (!empty($siteSettings->email)) {
            $schemaData['email'] = $siteSettings->email;
        }
        
        if (!empty($siteSettings->telephone)) {
            $schemaData['telephone'] = $siteSettings->telephone;
        }
        
        $socialLinks = [];
        if (!empty($siteSettings->facebook)) $socialLinks[] = $siteSettings->facebook;
        if (!empty($siteSettings->twitter)) $socialLinks[] = $siteSettings->twitter;
        if (!empty($siteSettings->instagram)) $socialLinks[] = $siteSettings->instagram;
        if (!empty($siteSettings->linkedin)) $socialLinks[] = $siteSettings->linkedin;
        if (!empty($siteSettings->youtube)) $socialLinks[] = $siteSettings->youtube;
        
        if (count($socialLinks) > 0) {
            $schemaData['sameAs'] = $socialLinks;
        }
    @endphp
    <script type="application/ld+json">
    {!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    
    <!-- Schema.org pour la page courante -->
    @stack('schema')
    
    <!-- Styles personnalisés -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <!-- Alpine.js pour interactivité fluide -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        /* Optimisations performance */
        * { box-sizing: border-box; }
        img { 
            loading: lazy;
            decoding: async;
        }
        
        /* Navigation fluide */
        .nav-transition {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Box shadow par défaut pour image à propos */
        .image-about-shadow {
            box-shadow: 0 25px 50px -12px rgba(139, 92, 246, 0.4);
        }
        
        /* Réduction animations pour performances */
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
<body class="font-sans bg-white text-gray-900 antialiased">
    <!-- Navigation moderne optimisée -->
    <nav x-data="{ mobileMenuOpen: false, scrolled: false }" 
         @scroll.window.throttle="scrolled = window.scrollY > 50"
         :class="{ 'bg-white shadow-lg': scrolled, 'bg-black/60 backdrop-blur-sm': !scrolled }"
         class="fixed top-0 w-full z-50 nav-transition border-b border-transparent overflow-visible"
         :class="{ 'border-gray-100': scrolled }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo site depuis paramétrage (fallback texte) -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    @php($logo = $siteSettings?->logo_url)
                    @if(!empty($logo))
                        <img src="{{ str_starts_with($logo, 'http') ? $logo : asset($logo) }}"
                             alt="Logo"
                             class="h-20 md:h-24 lg:h-28 -my-2 md:-my-4 w-auto max-w-none object-contain transition-transform duration-300 scale-[1.06] group-hover:scale-[1.12] bg-transparent drop-shadow-none"
                             :class="{ 'drop-shadow-[0_0_2px_rgba(0,0,0,0.8)] contrast-125': scrolled }"
                             style="aspect-ratio: 578 / 432;"
                             onerror="this.style.display='none'">
                    @else
                        <div class="text-2xl font-bold transition-transform duration-300 group-hover:scale-105"
                             :class="{ 'text-gray-800': scrolled, 'text-white': !scrolled }">
                            <span class="">Zee</span>
                            <span class="text-purple-400 relative">
                                e
                                <svg class="absolute -top-1 -right-1 w-3 h-3 text-purple-400 animate-pulse" viewBox="0 0 12 12" fill="currentColor">
                                    <path d="M6 0L7.5 4.5L12 6L7.5 7.5L6 12L4.5 7.5L0 12L4.5 4.5L6 0Z"/>
                                </svg>
                            </span>
                            <span class="">max</span>
                        </div>
                    @endif
                    
                </a>
                
                <!-- Menu desktop -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-lg font-medium transition-colors {{ request()->routeIs('home') ? 'text-purple-600' : '' }}"
                       :class="{ 'text-gray-700 hover:text-purple-600': scrolled, 'text-white hover:text-purple-300': !scrolled }">Accueil</a>
                    <a href="{{ route('apropos.index') }}" class="text-lg font-medium transition-colors {{ request()->routeIs('apropos.*') ? 'text-purple-600' : '' }}"
                       :class="{ 'text-gray-700 hover:text-purple-600': scrolled, 'text-white hover:text-purple-300': !scrolled }">À propos</a>
                    <a href="{{ route('services.index') }}" class="text-lg font-medium transition-colors {{ request()->routeIs('services.*') ? 'text-purple-600' : '' }}"
                       :class="{ 'text-gray-700 hover:text-purple-600': scrolled, 'text-white hover:text-purple-300': !scrolled }">Services</a>
                    <a href="{{ route('portfolio.index') }}" class="text-lg font-medium transition-colors {{ request()->routeIs('portfolio.*') ? 'text-purple-600' : '' }}"
                       :class="{ 'text-gray-700 hover:text-purple-600': scrolled, 'text-white hover:text-purple-300': !scrolled }">Portfolio</a>
                    <a href="{{ route('testimonials.index') }}" class="text-lg font-medium transition-colors {{ request()->routeIs('testimonials.*') ? 'text-purple-600' : '' }}"
                       :class="{ 'text-gray-700 hover:text-purple-600': scrolled, 'text-white hover:text-purple-300': !scrolled }">Témoignages</a>
                    <a href="{{ route('contact.index') }}" 
                       :class="{ 'bg-purple-600 text-white hover:bg-purple-700 shadow-lg hover:shadow-xl': scrolled, 'bg-white text-purple-600 hover:bg-gray-100 shadow-md hover:shadow-lg': !scrolled }"
                       class="text-lg px-6 py-2 rounded-full transition-all duration-300 transform hover:scale-105 font-medium {{ request()->routeIs('contact.*') ? 'bg-purple-600 text-white' : '' }}">
                        Contact
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 transition-colors"
                        :class="{ 'text-gray-700 hover:text-purple-600': scrolled, 'text-white hover:text-purple-300': !scrolled }">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95"
             class="md:hidden bg-white border-t border-gray-100">
            <div class="px-4 py-4 space-y-4">
                <a href="{{ route('home') }}" class="block text-lg text-gray-700 hover:text-purple-600 transition-colors font-medium {{ request()->routeIs('home') ? 'text-purple-600 font-bold' : '' }}">Accueil</a>
                <a href="{{ route('apropos.index') }}" class="block text-lg text-gray-700 hover:text-purple-600 transition-colors font-medium {{ request()->routeIs('apropos.*') ? 'text-purple-600 font-bold' : '' }}">À propos</a>
                <a href="{{ route('services.index') }}" class="block text-lg text-gray-700 hover:text-purple-600 transition-colors font-medium {{ request()->routeIs('services.*') ? 'text-purple-600 font-bold' : '' }}">Services</a>
                <a href="{{ route('portfolio.index') }}" class="block text-lg text-gray-700 hover:text-purple-600 transition-colors font-medium {{ request()->routeIs('portfolio.*') ? 'text-purple-600 font-bold' : '' }}">Portfolio</a>
                <a href="{{ route('testimonials.index') }}" class="block text-lg text-gray-700 hover:text-purple-600 transition-colors font-medium {{ request()->routeIs('testimonials.*') ? 'text-purple-600 font-bold' : '' }}">Témoignages</a>
                <a href="{{ route('contact.index') }}" class="block text-lg bg-purple-600 text-white px-6 py-2 rounded-full text-center font-medium shadow-lg hover:bg-purple-700 transition-colors">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="pt-0">
        @yield('content')
    </main>

    <!-- Footer moderne -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Logo footer et description -->
                <div class="md:col-span-2">
                    <img src="{{ asset('images/logo-footer.png') }}"
                         alt="Logo footer"
                         class="h-24 md:h-28 lg:h-32 w-auto max-w-none object-contain mb-6 bg-transparent"
                         onerror="this.style.display='none'">
                    <p class="text-gray-400 text-sm max-w-md leading-relaxed">
                        ZEEEMAX accompagne les entrepreneurs à révéler leur identité de marque avec un branding sur-mesure et une stratégie digitale impactante.
                    </p>
                </div>
                
                <!-- Liens rapides -->
                <div>
                    <h3 class="font-semibold text-lg mb-4">Liens rapides</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}#apropos" class="text-gray-400 hover:text-purple-400 transition-colors">À propos</a></li>
                        <li><a href="{{ route('home') }}#services" class="text-gray-400 hover:text-purple-400 transition-colors">Services</a></li>
                        <li><a href="{{ route('home') }}#portfolio" class="text-gray-400 hover:text-purple-400 transition-colors">Portfolio</a></li>
                        <li><a href="{{ route('home') }}#temoignages" class="text-gray-400 hover:text-purple-400 transition-colors">Témoignages</a></li>
                        <li><a href="{{ route('home') }}#contact" class="text-gray-400 hover:text-purple-400 transition-colors">Contact</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h3 class="font-semibold text-lg mb-4">Contact</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        @if(!empty($siteSettings?->email))
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <a href="mailto:{{ $siteSettings->email }}" class="hover:text-purple-300 transition-colors">{{ $siteSettings->email }}</a>
                        </li>
                        @endif
                        @if(!empty($siteSettings?->telephone))
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <a href="tel:{{ preg_replace('/\s+/', '', $siteSettings->telephone) }}" class="hover:text-purple-300 transition-colors">{{ $siteSettings->telephone }}</a>
                        </li>
                        @endif
                        @php($adresseComplete = collect([$siteSettings?->adresse, $siteSettings?->code_postal, $siteSettings?->ville, $siteSettings?->pays])->filter()->implode(', '))
                        @if(!empty($adresseComplete))
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>{{ $adresseComplete }}</span>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 text-center">
                <p class="text-gray-500 text-sm">
                    © {{ date('Y') }} ZEEEMAX. Tous droits réservés. | Designed with ❤️ for entrepreneurs
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts pour smooth scrolling -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling pour les liens d'ancrage
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
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
        });
    </script>
    
    @stack('scripts')
</body>
</html>

