@extends('layouts.admin-sidebar')

@section('title', 'Modifier la Section "À propos" - ZEEEMAX Admin')
@section('page-title', 'Modifier la Section "À propos"')
@section('page-description', 'Éditez les informations de la section')

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
                <a href="{{ route('admin.apropos.index') }}" class="hover:text-blue-600 transition-colors">À propos</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-blue-600">Modifier</span>
            </div>
            <p class="text-gray-600 dark:text-gray-300">Section : <strong>{{ $apropos->titre }}</strong></p>
        </div>
        
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.apropos.show', $apropos) }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-green-600 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Voir
            </a>
            <a href="{{ route('admin.apropos.index') }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour
            </a>
        </div>
    </div>

    <!-- Formulaire -->
    <div class="glass dark:glass-dark rounded-2xl overflow-hidden animate-slide-up">
        <form action="{{ route('admin.apropos.update', $apropos->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 p-8">
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
                       value="{{ old('titre', $apropos->titre) }}"
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
                          class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">{{ old('description', $apropos->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image -->
            <div>
                <label for="image_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Image
                </label>
                <input type="file" 
                       id="image_file" 
                       name="image_file" 
                       accept="image/*"
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                @error('image_file')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Formats acceptés : JPG, PNG, GIF, WEBP (max 2MB)</p>
                
                <!-- Image actuelle -->
                @if($apropos->image_url)
                    <div class="mt-4 p-4 bg-gray-100 dark:bg-gray-800 rounded-xl">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Image actuelle :</p>
                        <img src="{{ str_starts_with($apropos->image_url, 'http') ? $apropos->image_url : asset($apropos->image_url) }}" 
                             alt="Image actuelle" 
                             class="w-64 h-48 object-cover bg-white dark:bg-gray-700 rounded-lg border-2 border-gray-300 dark:border-gray-600"
                             onerror="this.style.display='none'">
                    </div>
                @endif
                
                <!-- Aperçu de la nouvelle image -->
                <div id="imagePreview" class="mt-4 hidden">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Aperçu de la nouvelle image :</p>
                    <img id="imagePreviewImg" 
                         src="" 
                         alt="Aperçu image" 
                         class="w-64 h-48 object-cover bg-gray-100 dark:bg-gray-800 rounded-lg border-2 border-blue-500">
                </div>
            </div>

            <!-- Métadonnées -->
            <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-4">
                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Informations</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600 dark:text-gray-400">
                    <div>Créé le : {{ $apropos->created_at->format('d/m/Y à H:i') }}</div>
                    <div>Modifié le : {{ $apropos->updated_at->format('d/m/Y à H:i') }}</div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.apropos.index') }}" 
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
            <form action="{{ route('admin.apropos.destroy', $apropos->id) }}" method="POST" id="delete-form-{{ $apropos->id }}">
                @csrf
                @method('DELETE')
            </form>
            <button type="button" 
                    onclick="confirmDeleteApropos({{ $apropos->id }}, '{{ $apropos->titre }}')"
                    class="px-6 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Supprimer cette section
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Aperçu de l'image en temps réel
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image_file');
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewImg = document.getElementById('imagePreviewImg');
        
        if (imageInput) {
            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreviewImg.src = e.target.result;
                        imagePreview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.classList.add('hidden');
                }
            });
        }
    });
    
    // Fonction de confirmation de suppression
    async function confirmDeleteApropos(id, titre) {
        const confirmed = await window.adminConfirm.confirm(
            `Êtes-vous sûr de vouloir supprimer la section "${titre}" ? Cette action est irréversible.`,
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
</script>
@endpush
@endsection

