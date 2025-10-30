@extends('layouts.admin-sidebar')

@section('title', 'Détails de la Valeur - ZEEEMAX Admin')
@section('page-title', 'Détails de la Valeur')
@section('page-description', 'Informations complètes sur la valeur')

@section('content')
<div>
    <!-- Header Section -->
    <div class="flex items-center justify-between mb-8 animate-fade-in">
        <div>
            <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors">Dashboard</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('admin.valeurs.index') }}" class="hover:text-blue-600 transition-colors">Valeurs</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-blue-600">{{ $valeur->titre }}</span>
            </div>
            <p class="text-gray-600 dark:text-gray-300">Détails de la valeur</p>
        </div>
        
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.valeurs.edit', $valeur->id) }}" class="flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Modifier
            </a>
            <a href="{{ route('admin.valeurs.index') }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour
            </a>
        </div>
    </div>

    <!-- Détails -->
    <div class="glass dark:glass-dark rounded-2xl overflow-hidden animate-slide-up">
        <div class="p-8">
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $valeur->titre }}</h2>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                        {{ $valeur->actif ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                        {{ $valeur->actif ? 'Actif' : 'Inactif' }}
                    </span>
                </div>
                
                <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                    <span>Ordre : <strong class="text-gray-900 dark:text-white">{{ $valeur->ordre }}</strong></span>
                    <span>•</span>
                    <span>Couleur : <strong class="text-gray-900 dark:text-white capitalize">{{ $valeur->couleur }}</strong></span>
                    <span>•</span>
                    <span>Créé le : <strong class="text-gray-900 dark:text-white">{{ $valeur->created_at->format('d/m/Y à H:i') }}</strong></span>
                    @if($valeur->updated_at != $valeur->created_at)
                    <span>•</span>
                    <span>Modifié le : <strong class="text-gray-900 dark:text-white">{{ $valeur->updated_at->format('d/m/Y à H:i') }}</strong></span>
                    @endif
                </div>
            </div>

            <!-- Icône -->
            @if($valeur->icon)
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Icône</label>
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 rounded-xl flex items-center justify-center 
                        @if($valeur->couleur === 'purple') bg-gradient-to-br from-purple-600 to-purple-700
                        @elseif($valeur->couleur === 'blue') bg-gradient-to-br from-blue-600 to-blue-700
                        @else bg-gradient-to-br from-purple-600 to-blue-600
                        @endif">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Nom de l'icône : <strong class="text-gray-900 dark:text-white">{{ $valeur->icon }}</strong></p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Description -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                <div class="bg-gray-50 dark:bg-gray-900 rounded-xl p-6">
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $valeur->description }}</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.valeurs.index') }}" 
                   class="px-6 py-3 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
                    Retour à la liste
                </a>
                
                <a href="{{ route('admin.valeurs.edit', $valeur->id) }}" 
                   class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Modifier
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

