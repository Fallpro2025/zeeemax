@extends('layouts.admin-sidebar')

@section('title', 'Dashboard Admin - ZEEEMAX')
@section('page-title', 'Dashboard')
@section('page-description', 'Bonjour ! Voici votre résumé d\'aujourd\'hui')

@section('content')
<div class="p-6 space-y-6">
                
                <!-- Stats Cards Ultra Modernes -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Services Card -->
                    <div class="glass dark:glass-dark rounded-2xl p-6 hover-lift animate-fade-in">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Services</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['services']['total'] }}</p>
                                <p class="text-sm text-green-600 dark:text-green-400 flex items-center mt-1">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    {{ $stats['services']['actifs'] }} actifs
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Portfolio Card -->
                    <div class="glass dark:glass-dark rounded-2xl p-6 hover-lift animate-fade-in" style="animation-delay: 0.1s;">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Portfolio</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['portfolio']['total'] }}</p>
                                <p class="text-sm text-blue-600 dark:text-blue-400 flex items-center mt-1">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    {{ $stats['portfolio']['featured'] }} mis en avant
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Témoignages Card -->
                    <div class="glass dark:glass-dark rounded-2xl p-6 hover-lift animate-fade-in" style="animation-delay: 0.2s;">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Témoignages</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['testimonials']['total'] }}</p>
                                <p class="text-sm text-blue-600 dark:text-blue-400 flex items-center mt-1">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    {{ $stats['testimonials']['featured'] }} mis en avant
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Messages Card -->
                    <div class="glass dark:glass-dark rounded-2xl p-6 hover-lift animate-fade-in" style="animation-delay: 0.3s;">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Messages</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['contacts']['total'] }}</p>
                                <p class="text-sm text-red-600 dark:text-red-400 flex items-center mt-1">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $stats['contacts']['nonLus'] }} non lus
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-gradient-to-r from-slate-600 to-slate-700 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Graphique et Actions Rapides -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- Graphique des performances (CSS pur) -->
                    <div class="lg:col-span-2 glass dark:glass-dark rounded-2xl p-6 animate-slide-up">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Performances du Site</h3>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 text-xs bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400 rounded-full">7j</button>
                                <button class="px-3 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded-full">30j</button>
                            </div>
                        </div>
                        
                        <!-- Simple CSS Chart -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Visites</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">1,247</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-blue-600 to-blue-700 h-2 rounded-full animate-glow" style="width: 75%"></div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Conversions</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">89</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 h-2 rounded-full animate-glow" style="width: 60%; animation-delay: 0.5s;"></div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Engagement</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">94%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-slate-600 to-slate-700 h-2 rounded-full animate-glow" style="width: 94%; animation-delay: 1s;"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Actions Rapides -->
                    <div class="glass dark:glass-dark rounded-2xl p-6 animate-slide-up" style="animation-delay: 0.2s;">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Actions Rapides</h3>
                        
                               <div class="space-y-3">
                                   <a href="{{ route('admin.services.create') }}" class="w-full flex items-center p-3 rounded-xl bg-gradient-to-r from-blue-600 to-blue-700 text-white hover:from-blue-700 hover:to-blue-800 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                       <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                       </svg>
                                       Nouveau Service
                                   </a>
                                   
                                   <a href="{{ route('admin.portfolio.create') }}" class="w-full flex items-center p-3 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-700 text-white hover:from-indigo-700 hover:to-indigo-800 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                       <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                       </svg>
                                       Ajouter Portfolio
                                   </a>
                                   
                                   <a href="{{ route('admin.testimonials.create') }}" class="w-full flex items-center p-3 rounded-xl bg-gradient-to-r from-slate-600 to-slate-700 text-white hover:from-slate-700 hover:to-slate-800 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                       <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                       </svg>
                                       Nouveau Témoignage
                                   </a>
                               </div>
                    </div>
                </div>
                
                <!-- Activité Récente et Informations Système -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    
                    <!-- Activité Récente -->
                    <div class="glass dark:glass-dark rounded-2xl p-6 animate-slide-up">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Activité Récente</h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-900 dark:text-white">Nouveau message de contact reçu</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Il y a 2 minutes</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-900 dark:text-white">Service "Branding" mis à jour</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Il y a 1 heure</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-purple-500 rounded-full mt-2"></div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-900 dark:text-white">Nouveau projet ajouté au portfolio</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Il y a 3 heures</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Informations Système -->
                    <div class="glass dark:glass-dark rounded-2xl p-6 animate-slide-up" style="animation-delay: 0.2s;">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Informations Système</h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-xl">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">Laravel</span>
                                </div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ app()->version() }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-xl">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">PHP</span>
                                </div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ PHP_VERSION }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-xl">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">Dernière connexion</span>
                                </div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ now()->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
</div>
@endsection
