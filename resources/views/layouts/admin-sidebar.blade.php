<!DOCTYPE html>
<html lang="fr" x-data="{ darkMode: false, sidebarOpen: false }" :class="{ 'dark': darkMode }">
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
            display: grid;
            grid-template-columns: 260px 1fr;
            min-height: 100vh;
            background: #f5f7fa;
        }
        
        @media (max-width: 1023px) {
            .dashboard-layout {
                grid-template-columns: 1fr;
            }
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
        }
        
        .dark .sidebar {
            background: #1a2332;
        }
        
        .dashboard-main {
            padding: 24px 32px;
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
            position: relative;
            z-index: 1;
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
                <div class="text-2xl font-bold">
                    <span class="text-white">Zee</span><span class="text-blue-400">e</span><span class="text-white">max</span>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    Dashboard
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
                
                <a href="{{ route('admin.contacts.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.contacts.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Messages
                </a>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="dashboard-main">
            
            <!-- Header -->
            <header class="glass border-b mb-6 sticky top-0 z-10">
                <div class="flex items-center justify-between py-4">
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
                
                <div class="flex items-center justify-between pb-4">
                    <div>
                        @stack('breadcrumb')
                    </div>
                    <div>
                        @stack('page-actions')
                    </div>
                </div>
            </header>
            
            <!-- Content -->
            @yield('content')
            
        </main>
    </div>

    <!-- Toast Messages -->
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="fixed top-4 right-4 z-50 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="fixed top-4 right-4 z-50 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    @stack('scripts')
</body>
</html>
