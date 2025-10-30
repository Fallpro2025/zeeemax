@extends('layouts.admin-sidebar')

@section('title', 'Créer un Témoignage - ZEEEMAX Admin')
@section('page-title', 'Créer un Témoignage')
@section('page-description', 'Ajoutez un nouveau témoignage client')

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
                <a href="{{ route('admin.testimonials.index') }}" class="hover:text-blue-600 transition-colors">Témoignages</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-blue-600">Créer</span>
            </div>
            <p class="text-gray-600 dark:text-gray-300">Partagez la satisfaction de vos clients</p>
        </div>
        
        <a href="{{ route('admin.testimonials.index') }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Retour
        </a>
    </div>

    <!-- Formulaire -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 p-8">
            @csrf
            
            <!-- Informations client -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="nom_client" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nom du client *
                    </label>
                    <input type="text" 
                           id="nom_client" 
                           name="nom_client" 
                           value="{{ old('nom_client') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                           placeholder="Aida Thiam ou Codou Mbaye"
                           required>
                    @error('nom_client')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="profession" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Profession *
                    </label>
                    <input type="text" 
                           id="profession" 
                           name="profession" 
                           value="{{ old('profession') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                           placeholder="CEO, Entreprise XYZ"
                           required>
                    @error('profession')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Contenu du témoignage -->
            <div>
                <label for="contenu" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Témoignage *
                </label>
                <textarea id="contenu" 
                          name="contenu" 
                          rows="5"
                          class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                          placeholder="Partagez l'expérience et la satisfaction du client..."
                          required>{{ old('contenu') }}</textarea>
                @error('contenu')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Note et métrique -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="note" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Note (sur 5) *
                    </label>
                    <select id="note" 
                            name="note" 
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                            required>
                        <option value="">Choisir une note</option>
                        <option value="5" {{ old('note') == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5/5)</option>
                        <option value="4" {{ old('note') == '4' ? 'selected' : '' }}>⭐⭐⭐⭐ (4/5)</option>
                        <option value="3" {{ old('note') == '3' ? 'selected' : '' }}>⭐⭐⭐ (3/5)</option>
                        <option value="2" {{ old('note') == '2' ? 'selected' : '' }}>⭐⭐ (2/5)</option>
                        <option value="1" {{ old('note') == '1' ? 'selected' : '' }}>⭐ (1/5)</option>
                    </select>
                    @error('note')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="metrique" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Métrique (optionnel)
                    </label>
                    <input type="text" 
                           id="metrique" 
                           name="metrique" 
                           value="{{ old('metrique') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                           placeholder="+300% de ventes, -50% de temps">
                    @error('metrique')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Avatar et options -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="avatar_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Avatar du client (optionnel)
                    </label>
                    <input type="file" 
                           id="avatar_file" 
                           name="avatar_file" 
                           accept="image/*"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                    @error('avatar_file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Formats acceptés : JPG, PNG, GIF, WEBP (max 2MB). Une image par défaut sera utilisée si aucune image n'est téléchargée.</p>
                    
                    <!-- Aperçu de l'avatar -->
                    <div id="avatarPreview" class="mt-4 hidden">
                        <img id="previewAvatarImg" src="#" alt="Aperçu" class="w-20 h-20 rounded-full object-cover border-2 border-gray-300 dark:border-gray-600">
                    </div>
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

            <!-- Options -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label class="flex items-center">
                        <input type="hidden" name="featured" value="0">
                        <input type="checkbox" 
                               name="featured" 
                               value="1" 
                               {{ old('featured') ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Témoignage mis en avant</span>
                    </label>
                </div>
                
                <div>
                    <label class="flex items-center">
                        <input type="hidden" name="actif" value="0">
                        <input type="checkbox" 
                               name="actif" 
                               value="1" 
                               {{ old('actif', true) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Témoignage actif</span>
                    </label>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.testimonials.index') }}" 
                   class="px-6 py-3 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
                    Annuler
                </a>
                
                <button type="submit" 
                        class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Créer le témoignage
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Aperçu de l'avatar
    document.getElementById('avatar_file').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('avatarPreview');
                const previewImg = document.getElementById('previewAvatarImg');
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush

@endsection

