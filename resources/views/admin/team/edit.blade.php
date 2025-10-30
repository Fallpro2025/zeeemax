@extends('layouts.admin-sidebar')

@section('title', 'Modifier le Membre - ZEEEMAX Admin')
@section('page-title', 'Modifier le Membre')
@section('page-description', 'Éditez les informations du membre')

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
                <a href="{{ route('admin.team.index') }}" class="hover:text-blue-600 transition-colors">Équipe</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-blue-600">Modifier</span>
            </div>
            <p class="text-gray-600 dark:text-gray-300">Membre : <strong>{{ $team->nom }}</strong></p>
        </div>
        
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.team.show', $team) }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-green-600 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Voir
            </a>
            <button type="button" onclick="confirmDeleteEdit({{ $team->id }}, '{{ $team->nom }}')" class="flex items-center px-4 py-2 text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Supprimer
            </button>
            <a href="{{ route('admin.team.index') }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour
            </a>
        </div>
    </div>

    <!-- Formulaire -->
    <div class="glass dark:glass-dark rounded-2xl overflow-hidden animate-slide-up">
        <form action="{{ route('admin.team.update', $team->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 p-8">
            @csrf
            @method('PUT')
            
            <!-- Nom et Poste -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nom *
                    </label>
                    <input type="text" 
                           id="nom" 
                           name="nom" 
                           value="{{ old('nom', $team->nom) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                           placeholder="Aida Thiam ou Codou Mbaye"
                           required>
                    @error('nom')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="poste" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Poste *
                    </label>
                    <input type="text" 
                           id="poste" 
                           name="poste" 
                           value="{{ old('poste', $team->poste) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                           required>
                    @error('poste')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Bio et Photo -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Bio (optionnel)
                    </label>
                    <textarea id="bio" 
                              name="bio" 
                              rows="4"
                              class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">{{ old('bio', $team->bio) }}</textarea>
                    @error('bio')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="photo_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Photo du membre
                    </label>
                    <input type="file" 
                           id="photo_file" 
                           name="photo_file" 
                           accept="image/*"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                    @error('photo_file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Formats acceptés : JPG, PNG, GIF, WEBP (max 2MB)</p>
                    
                    <!-- Photo actuelle -->
                    @if($team->photo_url)
                        <div class="mt-4 p-4 bg-gray-100 dark:bg-gray-800 rounded-xl">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Photo actuelle :</p>
                            <img src="{{ str_starts_with($team->photo_url, 'http') ? $team->photo_url : asset($team->photo_url) }}" 
                                 alt="Photo actuelle" 
                                 class="w-32 h-32 rounded-full object-cover border-2 border-gray-300 dark:border-gray-600"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($team->nom) }}&background=blue&color=fff&size=128'">
                        </div>
                    @endif
                    
                    <!-- Aperçu de la nouvelle photo -->
                    <div id="photoPreview" class="mt-4 hidden">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Nouvelle photo :</p>
                        <img id="previewPhotoImg" src="#" alt="Aperçu" class="w-32 h-32 rounded-full object-cover border-2 border-gray-300 dark:border-gray-600">
                    </div>
                </div>
            </div>

            <!-- Réseaux sociaux -->
            <div>
                <label for="reseau_social" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Réseaux sociaux (optionnel)
                </label>
                <input type="text" 
                       id="reseau_social" 
                       name="reseau_social" 
                       value="{{ old('reseau_social', is_array($team->reseau_social) ? implode(', ', $team->reseau_social) : $team->reseau_social) }}"
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                @error('reseau_social')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Séparez les liens par des virgules</p>
            </div>

            <!-- Statut et Ordre -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label class="flex items-center">
                        <input type="hidden" name="actif" value="0">
                        <input type="checkbox" 
                               name="actif" 
                               value="1" 
                               {{ old('actif', $team->actif) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Membre actif</span>
                    </label>
                </div>
                
                <div>
                    <label for="ordre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Ordre d'affichage
                    </label>
                    <input type="number" 
                           id="ordre" 
                           name="ordre" 
                           value="{{ old('ordre', $team->ordre) }}"
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
                    <div>Créé le : {{ $team->created_at->format('d/m/Y à H:i') }}</div>
                    <div>Modifié le : {{ $team->updated_at->format('d/m/Y à H:i') }}</div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.team.index') }}" 
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
            <form action="{{ route('admin.team.destroy', $team->id) }}" method="POST" id="delete-form-{{ $team->id }}">
                @csrf
                @method('DELETE')
            </form>
            <button type="button" 
                    onclick="confirmDeleteTeam({{ $team->id }}, '{{ $team->nom }}')"
                    class="px-6 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Supprimer ce membre
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Fonction de confirmation de suppression
    async function confirmDeleteTeam(id, name) {
        const confirmed = await window.adminConfirm.confirm(
            `Êtes-vous sûr de vouloir supprimer ce membre "${name}" ? Cette action est irréversible.`,
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

    // Aperçu de la photo
    document.getElementById('photo_file').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('photoPreview');
                const previewImg = document.getElementById('previewPhotoImg');
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush

@endsection

