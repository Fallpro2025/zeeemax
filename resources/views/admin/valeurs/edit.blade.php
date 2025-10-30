@extends('layouts.admin-sidebar')

@section('title', 'Modifier une Valeur - ZEEEMAX Admin')
@section('page-title', 'Modifier une Valeur')
@section('page-description', 'Éditez les informations de la valeur')

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
                <span class="text-blue-600">Modifier</span>
            </div>
            <p class="text-gray-600 dark:text-gray-300">Valeur : <strong>{{ $valeur->titre }}</strong></p>
        </div>
        
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.valeurs.show', $valeur->id) }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-green-600 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Voir
            </a>
            <a href="{{ route('admin.valeurs.index') }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour
            </a>
        </div>
    </div>

    <!-- Formulaire -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <form action="{{ route('admin.valeurs.update', $valeur->id) }}" method="POST" class="space-y-6 p-8">
            @csrf
            @method('PUT')
            
            <!-- Titre -->
            <div>
                <label for="titre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Titre * 
                </label>
                <input type="text" 
                       id="titre" 
                       name="titre" 
                       value="{{ old('titre', $valeur->titre) }}"
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                       required>
                @error('titre')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Description *
                </label>
                <textarea id="description" 
                          name="description" 
                          rows="6"
                          class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">{{ old('description', $valeur->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Icône et Couleur -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Icône
                    </label>
                    <input type="hidden" id="icon" name="icon" value="{{ old('icon', $valeur->icon ?? '') }}">
                    
                    <p class="mb-3 text-xs text-gray-500 dark:text-gray-400">Sélectionnez une icône pour cette valeur</p>
                    
                    <!-- Grille d'icônes SVG -->
                    <div class="grid grid-cols-6 gap-2 p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-800/50 max-h-64 overflow-y-auto">
                        <!-- Option "Aucune" -->
                        <button type="button" 
                                onclick="selectIcon('')"
                                class="icon-option p-2 border-2 rounded-lg transition-all duration-200 flex flex-col items-center justify-center {{ (old('icon', $valeur->icon ?? '') === '') ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/30' : 'border-transparent hover:border-gray-400 dark:hover:border-gray-500 bg-white dark:bg-gray-700' }}">
                            <div class="w-6 h-6 flex items-center justify-center text-gray-400 mb-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <span class="text-[10px] text-gray-600 dark:text-gray-400 leading-tight">Aucune</span>
                        </button>
                        
                        <!-- Icônes prédéfinies -->
                        @php
                        $icons = [
                            'lightning' => ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>', 'label' => 'Éclair'],
                            'shield' => ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>', 'label' => 'Bouclier'],
                            'heart' => ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>', 'label' => 'Cœur'],
                            'star' => ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>', 'label' => 'Étoile'],
                            'rocket' => ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>', 'label' => 'Fusée'],
                            'target' => ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>', 'label' => 'Cible'],
                            'users' => ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>', 'label' => 'Users'],
                            'globe' => ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>', 'label' => 'Globe'],
                            'bulb' => ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>', 'label' => 'Ampoule'],
                            'trophy' => ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>', 'label' => 'Trophée'],
                            'handshake' => ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>', 'label' => 'Poignée'],
                            'check-circle' => ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>', 'label' => 'Check']
                        ];
                        @endphp
                        
                        @foreach($icons as $iconKey => $iconData)
                        <button type="button" 
                                onclick="selectIcon('{{ $iconKey }}')"
                                class="icon-option p-2 border-2 rounded-lg transition-all duration-200 flex flex-col items-center justify-center {{ (old('icon', $valeur->icon ?? '') === $iconKey) ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/30' : 'border-transparent hover:border-gray-400 dark:hover:border-gray-500 bg-white dark:bg-gray-700' }}"
                                data-icon="{{ $iconKey }}">
                            <div class="w-6 h-6 flex items-center justify-center text-purple-600 mb-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $iconData['svg'] !!}
                                </svg>
                            </div>
                            <span class="text-[10px] text-gray-600 dark:text-gray-400 leading-tight">{{ $iconData['label'] }}</span>
                        </button>
                        @endforeach
                    </div>
                    
                    @error('icon')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    
                    <!-- Aperçu de l'icône sélectionnée -->
                    <div id="icon-preview" class="mt-3 p-3 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-800/50 flex items-center justify-center" style="min-height: 60px;">
                        <div id="icon-preview-content" class="w-12 h-12 flex items-center justify-center">
                        </div>
                    </div>
                </div>
                
                <div>
                    <label for="couleur" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Couleur *
                    </label>
                    <select id="couleur" name="couleur" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                        <option value="purple" {{ old('couleur', $valeur->couleur) === 'purple' ? 'selected' : '' }}>Violet</option>
                        <option value="blue" {{ old('couleur', $valeur->couleur) === 'blue' ? 'selected' : '' }}>Bleu</option>
                        <option value="purple-blue" {{ old('couleur', $valeur->couleur) === 'purple-blue' ? 'selected' : '' }}>Violet-Bleu (dégradé)</option>
                    </select>
                    @error('couleur')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Ordre -->
            <div>
                <label for="ordre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Ordre d'affichage
                </label>
                <input type="number" 
                       id="ordre" 
                       name="ordre" 
                       value="{{ old('ordre', $valeur->ordre) }}"
                       min="0"
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                @error('ordre')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actif -->
            <div class="flex items-center">
                <input type="checkbox" 
                       id="actif" 
                       name="actif" 
                       value="1"
                       {{ old('actif', $valeur->actif) ? 'checked' : '' }}
                       class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <label for="actif" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Valeur active
                </label>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.valeurs.index') }}" 
                   class="px-6 py-3 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
                    Annuler
                </a>
                
                <button type="submit" 
                        class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
    
    <!-- Formulaire de suppression séparé -->
    <div class="mt-6 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="px-8 pb-8 pt-6">
            <form action="{{ route('admin.valeurs.destroy', $valeur->id) }}" method="POST" id="delete-form-{{ $valeur->id }}">
                @csrf
                @method('DELETE')
            </form>
            <button type="button" 
                    onclick="confirmDelete({{ $valeur->id }}, '{{ $valeur->titre }}', 'valeur')"
                    class="px-6 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Supprimer cette valeur
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    async function confirmDelete(id, titre, type) {
        const confirmed = await window.adminConfirm.confirm(
            `Êtes-vous sûr de vouloir supprimer la ${type} "${titre}" ? Cette action est irréversible.`,
            {
                title: 'Confirmation de suppression',
                confirmText: 'Supprimer',
                cancelText: 'Annuler',
                type: 'danger',
                confirmClass: 'bg-red-600 hover:bg-red-700',
                cancelClass: 'bg-gray-500 hover:bg-gray-600'
            }
        );
        
        if (confirmed) {
            const form = document.getElementById(`delete-form-${id}`);
            window.adminAlert.info('Suppression en cours...');
            form.submit();
        }
    }
    
    // Icônes SVG mapping pour l'aperçu
    const iconsMap = {
        'lightning': '<svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>',
        'shield': '<svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>',
        'heart': '<svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>',
        'star': '<svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>',
        'rocket': '<svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>',
        'target': '<svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>',
        'users': '<svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>',
        'globe': '<svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        'bulb': '<svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>',
        'trophy': '<svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>',
        'handshake': '<svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>',
        'check-circle': '<svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
    };
    
    function selectIcon(iconValue) {
        const iconInput = document.getElementById('icon');
        const iconPreview = document.getElementById('icon-preview');
        const iconPreviewContent = document.getElementById('icon-preview-content');
        const iconOptions = document.querySelectorAll('.icon-option');
        
        // Mettre à jour la valeur du champ caché
        iconInput.value = iconValue;
        
        // Mettre à jour l'apparence des boutons
        iconOptions.forEach(option => {
            const iconKey = option.getAttribute('data-icon') || '';
            if (iconKey === iconValue) {
                option.classList.remove('border-transparent', 'hover:border-gray-400', 'dark:hover:border-gray-500', 'bg-white', 'dark:bg-gray-700');
                option.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/30');
            } else {
                option.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/30');
                option.classList.add('border-transparent', 'hover:border-gray-400', 'dark:hover:border-gray-500', 'bg-white', 'dark:bg-gray-700');
            }
        });
        
        // Mettre à jour l'aperçu
        if (iconValue && iconsMap[iconValue]) {
            iconPreviewContent.innerHTML = iconsMap[iconValue];
            iconPreview.style.display = 'flex';
        } else {
            iconPreview.style.display = 'none';
        }
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser l'état initial
        const iconInput = document.getElementById('icon');
        if (iconInput.value) {
            selectIcon(iconInput.value);
        } else {
            selectIcon('');
        }
    });
</script>
@endpush

@endsection

