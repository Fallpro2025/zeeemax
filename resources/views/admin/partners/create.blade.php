@extends('layouts.admin-sidebar')

@section('title', 'Créer un Partenaire - ZEEEMAX Admin')
@section('page-title', 'Créer un Partenaire')
@section('page-description', 'Ajoutez un nouveau partenaire')

@section('content')
<div>
    
    <!-- Header Section -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors">Dashboard</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('admin.partners.index') }}" class="hover:text-blue-600 transition-colors">Partenaires</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-blue-600">Créer</span>
            </div>
            <p class="text-gray-600 dark:text-gray-300">Ajoutez un nouveau partenaire</p>
        </div>
        
        <a href="{{ route('admin.partners.index') }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Retour
        </a>
    </div>

    <!-- Formulaire -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <form action="{{ route('admin.partners.store') }}" method="POST" class="space-y-6 p-8">
            @csrf
            
            <!-- Nom -->
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Nom du partenaire *
                </label>
                <input type="text" 
                       id="nom" 
                       name="nom" 
                       value="{{ old('nom') }}"
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                       placeholder="Ex: Société XYZ"
                       required>
                @error('nom')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Description (optionnel)
                </label>
                <textarea id="description" 
                          name="description" 
                          rows="4"
                          class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                          placeholder="Décrivez votre partenaire...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Logo et Site Web -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="logo_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        URL du logo (optionnel)
                    </label>
                    <input type="url" 
                           id="logo_url" 
                           name="logo_url" 
                           value="{{ old('logo_url') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                           placeholder="https://exemple.com/logo.png">
                    @error('logo_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="site_web" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Site Web (optionnel)
                    </label>
                    <input type="url" 
                           id="site_web" 
                           name="site_web" 
                           value="{{ old('site_web') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                           placeholder="https://exemple.com">
                    @error('site_web')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Statut et Ordre -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label class="flex items-center">
                        <input type="hidden" name="actif" value="0">
                        <input type="checkbox" 
                               name="actif" 
                               value="1" 
                               {{ old('actif', true) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Partenaire actif</span>
                    </label>
                </div>
                
                <div>
                    <label for="ordre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Ordre d'affichage
                    </label>
                    <input type="number" 
                           id="ordre" 
                           name="ordre" 
                           value="{{ old('ordre', 0) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                           min="0">
                    @error('ordre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.partners.index') }}" 
                   class="px-6 py-3 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
                    Annuler
                </a>
                
                <div class="flex items-center space-x-4">
                    <button type="submit" 
                            name="action" 
                            value="save_continue"
                            class="px-6 py-3 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition-colors">
                        Enregistrer et continuer
                    </button>
                    <button type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                        Créer le partenaire
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

