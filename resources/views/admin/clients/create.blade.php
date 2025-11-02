@extends('layouts.admin-sidebar')

@section('title', 'Créer un Client - ZEEEMAX Admin')
@section('page-title', 'Créer un Client')
@section('page-description', 'Ajoutez un nouveau client')

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
                <a href="{{ route('admin.clients.index') }}" class="hover:text-blue-600 transition-colors">Clients</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-blue-600">Créer</span>
            </div>
            <p class="text-gray-600 dark:text-gray-300">Ajoutez un nouveau client</p>
        </div>
        
        <a href="{{ route('admin.clients.index') }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Retour
        </a>
    </div>

    <!-- Formulaire -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 p-8">
            @csrf
            
            <!-- Nom et Type -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nom du client *
                    </label>
                    <input type="text" 
                           id="nom" 
                           name="nom" 
                           value="{{ old('nom') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                           placeholder="Ex: Coumba"
                           required>
                    @error('nom')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Type d'activité
                    </label>
                    <input type="text" 
                           id="type" 
                           name="type" 
                           value="{{ old('type') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                           placeholder="Ex: Influenceuse Beauté, Entrepreneure, Coach...">
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Logo -->
            <div>
                <label for="logo_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Logo du client
                </label>
                <input type="file" 
                       id="logo_file" 
                       name="logo_file" 
                       accept="image/*"
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                @error('logo_file')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Formats acceptés : JPG, PNG, GIF, WEBP (max 5MB)</p>
                
                <!-- Ou URL -->
                <div class="mt-4">
                    <label for="logo_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Ou URL du logo
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
                
                <!-- Aperçu du logo -->
                <div id="logoPreview" class="mt-4 hidden">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Aperçu :</p>
                    <div class="w-32 h-32 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center border-2 border-gray-300 dark:border-gray-600 overflow-hidden">
                        <img id="logoPreviewImg" 
                             src="" 
                             alt="Aperçu logo" 
                             class="w-full h-full object-cover hidden">
                        <span id="logoPreviewInitial" class="text-4xl font-bold text-gray-600 dark:text-gray-400 hidden"></span>
                    </div>
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
                        <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Client actif</span>
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
                <a href="{{ route('admin.clients.index') }}" 
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
                        Créer le client
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Aperçu du logo en temps réel
    document.addEventListener('DOMContentLoaded', function() {
        const logoInput = document.getElementById('logo_file');
        const logoUrlInput = document.getElementById('logo_url');
        const logoPreview = document.getElementById('logoPreview');
        const logoPreviewImg = document.getElementById('logoPreviewImg');
        const logoPreviewInitial = document.getElementById('logoPreviewInitial');
        const nomInput = document.getElementById('nom');
        
        function updatePreview(imgSrc = null, initial = null) {
            if (imgSrc) {
                logoPreviewImg.src = imgSrc;
                logoPreviewImg.classList.remove('hidden');
                logoPreviewInitial.classList.add('hidden');
                logoPreview.classList.remove('hidden');
            } else if (initial) {
                logoPreviewInitial.textContent = initial.toUpperCase();
                logoPreviewInitial.classList.remove('hidden');
                logoPreviewImg.classList.add('hidden');
                logoPreview.classList.remove('hidden');
            } else {
                logoPreview.classList.add('hidden');
            }
        }
        
        if (logoInput) {
            logoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        updatePreview(e.target.result);
                    };
                    reader.readAsDataURL(file);
                } else {
                    updatePreview();
                }
            });
        }
        
        if (logoUrlInput) {
            logoUrlInput.addEventListener('input', function() {
                if (this.value) {
                    updatePreview(this.value);
                } else {
                    updatePreview();
                }
            });
        }
        
        if (nomInput) {
            nomInput.addEventListener('input', function() {
                if (!logoInput?.files[0] && !logoUrlInput?.value) {
                    updatePreview(null, this.value.charAt(0));
                }
            });
        }
    });
</script>
@endpush
@endsection

