@extends('layouts.admin-sidebar')

@section('title', 'Modifier le Client - ZEEEMAX Admin')
@section('page-title', 'Modifier le Client')
@section('page-description', 'Éditez les informations du client')

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
                <a href="{{ route('admin.clients.index') }}" class="hover:text-blue-600 transition-colors">Clients</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-blue-600">Modifier</span>
            </div>
            <p class="text-gray-600 dark:text-gray-300">Client : <strong>{{ $client->nom }}</strong></p>
        </div>
        
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.clients.show', $client) }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-green-600 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Voir
            </a>
            <a href="{{ route('admin.clients.index') }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour
            </a>
        </div>
    </div>

    <!-- Formulaire -->
    <div class="glass dark:glass-dark rounded-2xl overflow-hidden animate-slide-up">
        <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 p-8">
            @csrf
            @method('PUT')
            
            <!-- Nom et Type -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nom du client *
                    </label>
                    <input type="text" 
                           id="nom" 
                           name="nom" 
                           value="{{ old('nom', $client->nom) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
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
                           value="{{ old('type', $client->type) }}"
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
                           value="{{ old('logo_url', $client->logo_url) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                           placeholder="https://exemple.com/logo.png">
                    @error('logo_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Logo actuel -->
                @if($client->logo_url)
                    <div class="mt-4 p-4 bg-gray-100 dark:bg-gray-800 rounded-xl">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Logo actuel :</p>
                        <div class="w-32 h-32 bg-black rounded-full flex items-center justify-center overflow-hidden border-2 border-gray-300 dark:border-gray-600">
                            <img src="{{ str_starts_with($client->logo_url, 'http') ? $client->logo_url : asset($client->logo_url) }}" 
                                 alt="Logo actuel" 
                                 class="w-full h-full object-cover"
                                 onerror="this.onerror=null; this.parentElement.innerHTML='<span class=\'text-white text-4xl font-bold\'>{{ strtoupper(substr($client->nom, 0, 1)) }}</span>'">
                        </div>
                    </div>
                @else
                    <div class="mt-4 p-4 bg-gray-100 dark:bg-gray-800 rounded-xl">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Logo actuel (initial) :</p>
                        <div class="w-32 h-32 bg-black rounded-full flex items-center justify-center text-white text-4xl font-bold border-2 border-gray-300 dark:border-gray-600">
                            {{ strtoupper(substr($client->nom, 0, 1)) }}
                        </div>
                    </div>
                @endif
                
                <!-- Aperçu du nouveau logo -->
                <div id="logoPreview" class="mt-4 hidden">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Aperçu du nouveau logo :</p>
                    <div class="w-32 h-32 bg-black rounded-full flex items-center justify-center overflow-hidden border-2 border-blue-500">
                        <img id="logoPreviewImg" 
                             src="" 
                             alt="Aperçu logo" 
                             class="w-full h-full object-cover hidden">
                        <span id="logoPreviewInitial" class="text-white text-4xl font-bold hidden"></span>
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
                               {{ old('actif', $client->actif) ? 'checked' : '' }}
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
                           value="{{ old('ordre', $client->ordre) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                           min="0">
                    @error('ordre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Métadonnées -->
            <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-4">
                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Informations</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600 dark:text-gray-400">
                    <div>Créé le : {{ $client->created_at->format('d/m/Y à H:i') }}</div>
                    <div>Modifié le : {{ $client->updated_at->format('d/m/Y à H:i') }}</div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.clients.index') }}" 
                       class="px-6 py-3 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
                        Annuler
                    </a>
                </div>
                
                <button type="submit" 
                        class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Mettre à jour
                </button>
            </div>
        </form>
        
        <!-- Formulaire de suppression séparé -->
        <div class="px-8 pb-8 border-t border-gray-200 dark:border-gray-700 pt-6">
            <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" id="delete-form-{{ $client->id }}">
                @csrf
                @method('DELETE')
            </form>
            <button type="button" 
                    onclick="confirmDeleteClient({{ $client->id }}, '{{ $client->nom }}')"
                    class="px-6 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Supprimer ce client
            </button>
        </div>
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
    
    // Fonction de confirmation de suppression
    function confirmDeleteClient(id, nom) {
        if (confirm(`Êtes-vous sûr de vouloir supprimer le client "${nom}" ? Cette action est irréversible.`)) {
            const form = document.getElementById(`delete-form-${id}`);
            form.submit();
        }
    }
</script>
@endpush
@endsection

