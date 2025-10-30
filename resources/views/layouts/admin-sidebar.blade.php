<!DOCTYPE html>
<html lang="fr" x-data="{ darkMode: false, sidebarOpen: false, openAdmin: false, openPages: false, openContent: false }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Admin ZEEEMAX')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .dashboard-layout {
            display: flex;
            min-height: 100vh;
            background: #f5f7fa;
        }
        
        @media (max-width: 1023px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 260px;
                height: 100vh;
                z-index: 50;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .sidebar.open {
                transform: translateX(0);
            }
        }
        
        .sidebar {
            background: #0e1a2b;
            color: white;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            width: 260px;
            flex-shrink: 0;
        }
        
        .dark .sidebar {
            background: #1a2332;
        }
        
        .dashboard-main {
            flex: 1;
            overflow-y: auto;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .dashboard-main-content {
            padding: 24px 32px;
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            flex: 1;
        }
        
        .card {
            background: white;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.04);
        }
        
        .dark .card {
            background: #1e293b;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        
        .glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }
        .dark .glass {
            background: rgba(30, 41, 59, 0.8);
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="dashboard-layout">
        
        <!-- Sidebar -->
        <aside class="sidebar" :class="{ 'open': sidebarOpen }">
            <!-- Logo -->
            <div class="flex items-center justify-center mb-8">
                @php($logo = $siteSettings?->logo_url ?? null)
                @if(!empty($logo))
                    <img src="{{ str_starts_with($logo, 'http') ? $logo : asset($logo) }}"
                         alt="ZEEEMAX"
                         class="h-16 w-auto object-contain bg-transparent scale-[1.12] -my-2"
                         onerror="this.style.display='none'">
                @else
                    <div class="text-2xl font-bold">
                        <span class="text-white">Zee</span><span class="text-blue-400">e</span><span class="text-white">max</span>
                    </div>
                @endif
            </div>
            
            <!-- Navigation -->
            <nav class="space-y-2 flex-grow">
                <!-- Section Gestion Admin -->
                <div class="mb-4">
                    <button @click="openAdmin = !openAdmin" class="w-full px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider flex items-center justify-between hover:text-white">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            Gestion Admin
                        </span>
                        <svg :class="openAdmin ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openAdmin" x-collapse>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        Dashboard
                    </a>
                    </div>
                </div>
                
                <!-- Section Rapports -->
                <div class="mb-4">
                    <a href="{{ route('admin.rapports.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.rapports.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Rapports
                    </a>
                </div>
                
                <!-- Section Administrateurs -->
                <div class="mb-4">
                    <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        Administrateurs
                    </div>
                    
                    <a href="{{ route('admin.admins.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.admins.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Gérer les Admins
                    </a>
                </div>
                
                <!-- Section Pages -->
                <div class="mb-4">
                    <button @click="openPages = !openPages" class="w-full px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider flex items-center justify-between hover:text-white">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Pages
                        </span>
                        <svg :class="openPages ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openPages" x-collapse>
                    <a href="{{ route('admin.homepage.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.homepage.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Accueil
                    </a>
                    </div>
                </div>
                
                <!-- Section Contenu -->
                <div class="mb-4">
                    <button @click="openContent = !openContent" class="w-full px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider flex items-center justify-between hover:text-white">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                            </svg>
                            Contenu
                        </span>
                        <svg :class="openContent ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                
                <div x-show="openContent" x-collapse>
                <a href="{{ route('admin.newsletters.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.newsletters.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2-1.343-2-3-2zm0 10c-4.418 0-8-1.79-8-4V8c0-2.21 3.582-4 8-4s8 1.79 8 4v6c0 2.21-3.582 4-8 4z"></path>
                    </svg>
                    Newsletters
                </a>

                <a href="{{ route('admin.subscribers.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.subscribers.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Abonnés
                </a>

                <a href="{{ route('admin.services.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.services.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                    </svg>
                    Services
                </a>
                
                <a href="{{ route('admin.portfolio.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.portfolio.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Portfolio
                </a>
                
                <a href="{{ route('admin.testimonials.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.testimonials.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                    Témoignages
                </a>
                
                <a href="{{ route('admin.team.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.team.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Équipe
                </a>
                
                <a href="{{ route('admin.partners.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.partners.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                    </svg>
                    Partenaires
                </a>
                
                <a href="{{ route('admin.apropos.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.apropos.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    À propos
                </a>
                
                <a href="{{ route('admin.valeurs.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.valeurs.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    Valeurs
                </a>
                
                <a href="{{ route('admin.contacts.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.contacts.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Messages
                </a>
                </div>
                </div>
            </nav>
            
            <!-- Paramétrage en bas -->
            <div class="mt-auto pt-4 border-t border-gray-700">
                <a href="{{ route('admin.site-settings.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.site-settings.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Paramétrage
                </a>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="dashboard-main">
            
            <!-- Header -->
            <header class="glass border-b sticky top-0 z-10 flex-shrink-0 mb-6">
                <div class="flex items-center justify-between py-4 px-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">@yield('page-title', 'Admin')</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400">@yield('page-description', 'Panneau d\'administration')</p>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <button @click="darkMode = !darkMode" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                            <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                            </svg>
                            <svg x-show="darkMode" class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </button>
                        
                        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        
                        <a href="{{ route('admin.profile.show') }}" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors {{ request()->routeIs('admin.profile.*') ? 'text-blue-600 dark:text-blue-400' : '' }}">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Mon Profil
                        </a>
                        
                        <a href="{{ route('home') }}" target="_blank" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">
                            Voir le site
                        </a>
                        
                        <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="flex items-center justify-between pb-4 px-6">
                    <div>
                        @stack('breadcrumb')
                    </div>
                    <div>
                        @stack('page-actions')
                    </div>
                </div>
            </header>
            
            <!-- Content -->
            <div class="dashboard-main-content">
                @yield('content')
            </div>
            
        </main>
    </div>

    <!-- Toast Messages -->
    @stack('scripts')
    
    <!-- CSS pour forcer les SVG à s'adapter -->
    <style>
        /* Override des classes Tailwind pour les SVG dans l'admin */
        .admin-icon svg {
            width: 100% !important;
            height: 100% !important;
            flex-shrink: 0 !important;
        }
    </style>
    
    <script>
        // Corriger les SVG pour qu'ils s'affichent correctement
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.admin-icon svg').forEach(svg => {
                // Forcer l'affichage
                svg.style.width = '100%';
                svg.style.height = '100%';
            });
        });
    </script>
    
    <!-- Admin Utils Script -->
    <script src="{{ asset('js/adminUtils.js') }}"></script>
    
    <!-- Admin Alerts System -->
    <script src="{{ asset('js/admin-alerts.js') }}"></script>
    
    <!-- Admin Confirm System -->
    <script src="{{ asset('js/admin-confirm.js') }}"></script>
    
    <!-- Flash Messages vers Alertes -->
    @if(session('success'))
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            window.adminAlert.success('{{ session('success') }}');
        });
    </script>
    @endif
    
    @if(session('error'))
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            window.adminAlert.error('{{ session('error') }}');
        });
    </script>
    @endif
</body>
</html>
