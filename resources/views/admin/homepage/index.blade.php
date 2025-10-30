@extends('layouts.admin-sidebar')

@section('title', 'Gestion de l\'Accueil - ZEEEMAX Admin')
@section('page-title', 'Gestion de l\'Accueil')
@section('page-description', 'Configurez le contenu de la page d\'accueil')

@section('content')
<div>
    
    <!-- Messages de succès/erreur -->
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl animate-slide-up">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif
    
    @if($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl animate-slide-up">
            <div class="flex items-start">
                <svg class="w-5 h-5 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-semibold">Erreurs dans le formulaire :</p>
                    <ul class="list-disc list-inside mt-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    
    <!-- Header Section -->
    <div class="flex items-center justify-between mb-8 animate-fade-in">
        <div>
            <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors">Dashboard</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-blue-600">Gestion de l'Accueil</span>
            </div>
            <p class="text-gray-600 dark:text-gray-300">Configurez le contenu et l'apparence de votre page d'accueil</p>
        </div>
        
        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Retour
        </a>
    </div>

    <!-- Formulaire -->
    <form action="{{ route('admin.homepage.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Contenu principal -->
        <div class="glass dark:glass-dark rounded-2xl p-8 animate-slide-up">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Contenu de l'Accueil
            </h3>
            
            <div class="space-y-6">
                <!-- Titre -->
                <div>
                    <label for="titre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Titre principal *
                    </label>
                    <input type="text" 
                           id="titre" 
                           name="titre" 
                           value="{{ old('titre', $homepage->titre) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                           placeholder="Bienvenue sur ZEEEMAX">
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
                              rows="4"
                              class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                              placeholder="Décrivez votre entreprise, votre mission...">{{ old('description', $homepage->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Background -->
        <div class="glass dark:glass-dark rounded-2xl p-8 animate-slide-up" style="animation-delay: 0.1s;">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Arrière-plan
            </h3>
            
            <div class="space-y-6">
                <!-- Type de background -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                        Type d'arrière-plan
                    </label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="flex items-center p-4 border-2 rounded-xl cursor-pointer transition-colors {{ old('background_type', $homepage->background_type) === 'image' ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20' : 'border-gray-300 dark:border-gray-600 hover:border-gray-400 dark:hover:border-gray-500' }}">
                            <input type="radio" 
                                   name="background_type" 
                                   value="image" 
                                   {{ old('background_type', $homepage->background_type) === 'image' ? 'checked' : '' }}
                                   class="mr-3 text-blue-600 focus:ring-blue-500"
                                   onchange="toggleBackgroundType('image')">
                            <svg class="w-6 h-6 mr-2 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="font-medium text-gray-900 dark:text-white">Image</span>
                        </label>
                        
                        <label class="flex items-center p-4 border-2 rounded-xl cursor-pointer transition-colors {{ old('background_type', $homepage->background_type) === 'video' ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20' : 'border-gray-300 dark:border-gray-600 hover:border-gray-400 dark:hover:border-gray-500' }}">
                            <input type="radio" 
                                   name="background_type" 
                                   value="video" 
                                   {{ old('background_type', $homepage->background_type) === 'video' ? 'checked' : '' }}
                                   class="mr-3 text-blue-600 focus:ring-blue-500"
                                   onchange="toggleBackgroundType('video')">
                            <svg class="w-6 h-6 mr-2 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <span class="font-medium text-gray-900 dark:text-white">Vidéo</span>
                        </label>
                    </div>
                </div>
                
                <!-- Upload Image -->
                <div id="image_section" class="{{ old('background_type', $homepage->background_type) === 'image' ? '' : 'hidden' }}">
                    <label for="background_image_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Image d'arrière-plan
                    </label>
                    <input type="file" 
                           id="background_image_file" 
                           name="background_image_file" 
                           accept="image/*"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                    @error('background_image_file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Formats acceptés : JPG, PNG, GIF, WEBP (max 5MB)</p>
                    
                    <!-- Image actuelle -->
                    @if($homepage->background_image_url && old('background_type', $homepage->background_type) !== 'video')
                        <div class="mt-4 p-4 bg-gray-100 dark:bg-gray-800 rounded-xl">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Image actuelle :</p>
                            <img src="{{ str_starts_with($homepage->background_image_url, 'http') ? $homepage->background_image_url : asset($homepage->background_image_url) }}" 
                                 alt="Background actuel" 
                                 class="w-full max-w-2xl h-64 object-cover rounded-lg border-2 border-gray-300 dark:border-gray-600"
                                 onerror="this.style.display='none'">
                        </div>
                    @endif
                    
                    <!-- Aperçu de la nouvelle image -->
                    <div id="imagePreview" class="mt-4 hidden">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Aperçu de la nouvelle image :</p>
                        <img id="imagePreviewImg" 
                             src="" 
                             alt="Aperçu" 
                             class="w-full max-w-2xl h-64 object-cover rounded-lg border-2 border-blue-500">
                    </div>
                </div>
                
                <!-- URL Vidéo -->
                <div id="video_section" class="{{ old('background_type', $homepage->background_type) === 'video' ? '' : 'hidden' }}">
                    <label for="background_video_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        URL de la vidéo d'arrière-plan
                    </label>
                    <input type="url" 
                           id="background_video_url" 
                           name="background_video_url" 
                           value="{{ old('background_video_url', $homepage->background_video_url) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                           placeholder="https://www.youtube.com/watch?v=... ou https://vimeo.com/... ou URL directe">
                    @error('background_video_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">URL YouTube, Vimeo ou lien direct vers un fichier vidéo</p>
                    
                    @if($homepage->background_video_url && old('background_type', $homepage->background_type) === 'video')
                        <div class="mt-4 p-4 bg-gray-100 dark:bg-gray-800 rounded-xl">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Vidéo actuelle :</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white break-all">{{ $homepage->background_video_url }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Bouton d'action (CTA) -->
        <div class="glass dark:glass-dark rounded-2xl p-8 animate-slide-up" style="animation-delay: 0.2s;">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                </svg>
                Bouton d'Action
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="bouton_texte" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Texte du bouton
                    </label>
                    <input type="text" 
                           id="bouton_texte" 
                           name="bouton_texte" 
                           value="{{ old('bouton_texte', $homepage->bouton_texte) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                           placeholder="Ex: Découvrir nos services">
                    @error('bouton_texte')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="bouton_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        URL du bouton
                    </label>
                    <input type="text" 
                           id="bouton_url" 
                           name="bouton_url" 
                           value="{{ old('bouton_url', $homepage->bouton_url) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                           placeholder="#services ou /contact">
                    @error('bouton_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Ancre (#services) ou route (/contact)</p>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end space-x-4 pt-6">
            <a href="{{ route('admin.dashboard') }}" 
               class="px-6 py-3 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
                Annuler
            </a>
            
            <button type="submit" 
                    class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Enregistrer la configuration
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Basculer entre image et vidéo
    function toggleBackgroundType(type) {
        const imageSection = document.getElementById('image_section');
        const videoSection = document.getElementById('video_section');
        
        if (type === 'image') {
            imageSection.classList.remove('hidden');
            videoSection.classList.add('hidden');
        } else {
            imageSection.classList.add('hidden');
            videoSection.classList.remove('hidden');
        }
    }
    
    // Initialisation au chargement
    document.addEventListener('DOMContentLoaded', function() {
        const selectedType = document.querySelector('input[name="background_type"]:checked')?.value || 'image';
        toggleBackgroundType(selectedType);
        
        // Aperçu de l'image en temps réel
        const imageInput = document.getElementById('background_image_file');
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
</script>
@endpush
@endsection

