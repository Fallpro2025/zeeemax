@extends('layouts.admin-sidebar')

@section('title', 'Détails Administrateur - ZEEEMAX Admin')
@section('page-title', 'Détails Administrateur')
@section('page-description', 'Informations de l\'administrateur')

@section('content')
<div>
    
    <!-- Header -->
    <div class="flex items-center justify-between mb-8 animate-fade-in">
        <div>
            <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors">Dashboard</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('admin.admins.index') }}" class="hover:text-blue-600 transition-colors">Administrateurs</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-blue-600">{{ $admin->nom }}</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $admin->nom }}</h1>
        </div>
        
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.admins.edit', $admin) }}" class="flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Modifier
            </a>
            <a href="{{ route('admin.admins.index') }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <div class="glass dark:glass-dark rounded-2xl p-8 animate-slide-up">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Informations</h2>
                
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Nom complet</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $admin->nom }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Email</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $admin->email }}</p>
                        </div>
                    </div>
                    
                    @if($admin->telephone)
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Téléphone</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $admin->telephone }}</p>
                    </div>
                    @endif
                    
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Statut</p>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $admin->actif ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200' }}">
                            {{ $admin->actif ? 'Actif' : 'Inactif' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="glass dark:glass-dark rounded-2xl p-6 animate-slide-up" style="animation-delay: 0.1s;">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informations</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">ID</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">#{{ $admin->id }}</span>
                    </div>
                    
                    <hr class="border-gray-200 dark:border-gray-700">
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Créé le</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $admin->created_at->format('d/m/Y') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Modifié le</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $admin->updated_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

