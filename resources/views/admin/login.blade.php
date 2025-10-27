<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Admin - ZEEEMAX</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Raleway', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.8s ease-out',
                        'slide-in-right': 'slideInRight 0.6s ease-out',
                        'float': 'float 3s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        },
                        slideInRight: {
                            '0%': { transform: 'translateX(50px)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        .gradient-overlay {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.9) 0%, rgba(236, 72, 153, 0.8) 100%);
        }
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="font-sans overflow-hidden">
    <!-- Container principal avec design split-screen -->
    <div class="min-h-screen flex">
        <!-- Côté gauche - Image avec overlay -->
        <div class="hidden lg:flex lg:w-1/2 relative">
            <!-- Image de fond moderne -->
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?q=80&w=1926&auto=format&fit=crop" 
                     alt="Espace de travail moderne" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 gradient-overlay"></div>
            </div>
            
            <!-- Contenu sur l'image -->
            <div class="relative z-10 flex flex-col justify-center px-12 text-white">
                <div class="animate-fade-in">
                    <div class="mb-8">
                        <div class="text-5xl font-bold mb-2 animate-float">
                            <span class="text-white">Zee</span>
                            <span class="text-yellow-300">e</span>
                            <span class="text-white">max</span>
                        </div>
                        <p class="text-xl text-purple-100 font-light">Brand Empowerment</p>
                    </div>
                    
                    <h1 class="text-4xl font-bold mb-6 leading-tight">
                        Interface<br>
                        <span class="text-yellow-300">d'Administration</span>
                    </h1>
                    
                    <p class="text-lg text-purple-100 leading-relaxed mb-8">
                        Gérez votre contenu, analysez vos performances et développez votre marque avec des outils professionnels.
                    </p>
                    
                    <div class="flex space-x-6 text-sm">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                            <span>Sécurisé</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-blue-400 rounded-full"></div>
                            <span>Moderne</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                            <span>Intuitif</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Éléments décoratifs flottants -->
            <div class="absolute top-20 right-20 w-32 h-32 bg-white bg-opacity-10 rounded-full animate-float"></div>
            <div class="absolute bottom-32 left-16 w-20 h-20 bg-purple-300 bg-opacity-20 rounded-full animate-float" style="animation-delay: 1s;"></div>
        </div>
        
        <!-- Côté droit - Formulaire -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gradient-to-br from-gray-50 to-gray-100">
            <div class="max-w-md w-full animate-slide-in-right">
                <!-- Header moderne -->
                <div class="text-center mb-8">
                    <div class="lg:hidden mb-6">
                        <div class="text-4xl font-bold">
                            <span class="text-gray-900">Zee</span>
                            <span class="text-purple-600">e</span>
                            <span class="text-gray-900">max</span>
                        </div>
                        <p class="text-purple-600 font-medium">Brand Empowerment</p>
                    </div>
                    
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">
                        Connexion Admin
                    </h2>
                    <p class="text-gray-600">
                        Accédez à votre espace d'administration
                    </p>
                </div>
                
                <!-- Formulaire moderne avec effet glass -->
                <div class="glass-effect rounded-2xl p-8 shadow-2xl">
                    <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Champ Email avec icône -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Adresse email
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                                <input id="email" name="email" type="email" required 
                                       value="{{ old('email') }}"
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/70" 
                                       placeholder="admin@zeeemax.com">
                            </div>
                        </div>
                        
                        <!-- Champ Mot de passe avec icône -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                Mot de passe
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <input id="password" name="password" type="password" required 
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white/70" 
                                       placeholder="••••••••">
                            </div>
                        </div>

                        <!-- Messages d'erreur modernes -->
                        @if ($errors->any())
                            <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-r-xl">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-semibold text-red-800">
                                            Erreur de connexion
                                        </h3>
                                        <div class="mt-1 text-sm text-red-700">
                                            @foreach ($errors->all() as $error)
                                                <p>{{ $error }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Message de succès moderne -->
                        @if (session('message'))
                            <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-r-xl">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-green-800">
                                            {{ session('message') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Bouton de connexion ultra-moderne -->
                        <div class="pt-2">
                            <button type="submit" 
                                    class="group relative w-full flex justify-center items-center py-4 px-6 border border-transparent text-base font-semibold rounded-xl text-white bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-purple-300 group-hover:text-purple-200 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                </span>
                                Se connecter
                            </button>
                        </div>
                    </form>
                    
                    <!-- Footer du formulaire -->
                    <div class="mt-6 text-center">
                        <p class="text-xs text-gray-500">
                            Interface sécurisée • ZEEEMAX Admin
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Version mobile - Image de fond -->
    <div class="lg:hidden fixed inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?q=80&w=1926&auto=format&fit=crop" 
             alt="Espace de travail moderne" 
             class="w-full h-full object-cover opacity-20">
    </div>
</body>
</html>

