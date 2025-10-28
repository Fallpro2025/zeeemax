@extends('layouts.admin-sidebar')

@section('title', 'Modifier le Projet - ZEEEMAX Admin')
@section('page-title', 'Modifier le Projet')
@section('page-description', 'Éditez les détails de votre projet')

@section('content')
<div >
    
    <!-- Header Section avec navigation -->
    <div class="flex items-center justify-between mb-8 animate-fade-in">
        <div>
            <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors">Dashboard</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('admin.portfolio.index') }}" class="hover:text-blue-600 transition-colors">Portfolio</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-blue-600">Modifier</span>
            </div>
            <p class="text-gray-600 dark:text-gray-300">Modifiez : <strong>{{ $portfolio->titre }}</strong></p>
        </div>
        
        <!-- Actions rapides -->
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.portfolio.show', ['portfolio' => $portfolio->id]) }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-green-600 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Voir
            </a>
            <a href="{{ route('admin.portfolio.index') }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour
            </a>
        </div>
    </div>

    <!-- Formulaire -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <form action="{{ route('admin.portfolio.update', ['portfolio' => $portfolio->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-6 p-8">
            @csrf
            @method('PUT')
            
            <!-- Titre et Slug -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="titre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Titre du projet *
                    </label>
                    <input type="text" 
                           id="titre" 
                           name="titre" 
                           value="{{ old('titre', $portfolio->titre) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors"
                           required>
                    @error('titre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Slug (URL) *
                    </label>
                    <input type="text" 
                           id="slug" 
                           name="slug" 
                           value="{{ old('slug', $portfolio->slug) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors">
                    @error('slug')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Catégorie et Image -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="categorie" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Catégorie *
                    </label>
                    <select id="categorie" 
                            name="categorie" 
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors"
                            required>
                        <option value="web" {{ old('categorie', $portfolio->categorie) == 'web' ? 'selected' : '' }}>Développement Web</option>
                        <option value="mobile" {{ old('categorie', $portfolio->categorie) == 'mobile' ? 'selected' : '' }}>Application Mobile</option>
                        <option value="design" {{ old('categorie', $portfolio->categorie) == 'design' ? 'selected' : '' }}>Design & Branding</option>
                        <option value="marketing" {{ old('categorie', $portfolio->categorie) == 'marketing' ? 'selected' : '' }}>Marketing Digital</option>
                        <option value="ecommerce" {{ old('categorie', $portfolio->categorie) == 'ecommerce' ? 'selected' : '' }}>E-commerce</option>
                        <option value="autre" {{ old('categorie', $portfolio->categorie) == 'autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                    @error('categorie')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="image_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Image du projet
                    </label>
                    <input type="file" 
                           id="image_file" 
                           name="image_file" 
                           accept="image/*"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                    @error('image_file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Formats acceptés : JPG, PNG, GIF, WEBP (max 5MB)</p>
                    
                    <!-- Image actuelle -->
                    @if($portfolio->image_url)
                        <div class="mt-4 p-4 bg-gray-100 dark:bg-gray-800 rounded-xl">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Image actuelle :</p>
                            <img src="{{ str_starts_with($portfolio->image_url, 'http') ? $portfolio->image_url : asset($portfolio->image_url) }}" 
                                 alt="Image actuelle" 
                                 class="w-full h-48 rounded-lg object-cover border border-gray-300 dark:border-gray-600">
                        </div>
                    @endif
                    
                    <!-- Aperçu de la nouvelle image -->
                    <div id="imagePreview" class="mt-4 hidden">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Nouvelle image :</p>
                        <img id="previewImg" src="#" alt="Aperçu" class="max-w-full h-64 rounded-xl object-cover border border-gray-300 dark:border-gray-600">
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Description *
                </label>
                <textarea id="description" 
                          name="description" 
                          rows="5"
                          class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors"
                          required>{{ old('description', $portfolio->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Technologies -->
            <div>
                <label for="technologies" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Technologies utilisées
                </label>
                <input type="text" 
                       id="technologies" 
                       name="technologies" 
                       value="{{ old('technologies', is_array($portfolio->technologies) ? implode(', ', $portfolio->technologies) : $portfolio->technologies) }}"
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors">
                @error('technologies')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Séparez les technologies par des virgules</p>
            </div>

            <!-- Liens -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="lien_demo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Lien de démo (optionnel)
                    </label>
                    <input type="url" 
                           id="lien_demo" 
                           name="lien_demo" 
                           value="{{ old('lien_demo', $portfolio->lien_demo) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors">
                    @error('lien_demo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="lien_github" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Lien GitHub (optionnel)
                    </label>
                    <input type="url" 
                           id="lien_github" 
                           name="lien_github" 
                           value="{{ old('lien_github', $portfolio->lien_github) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors">
                    @error('lien_github')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Options -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div>
                    <label class="flex items-center">
                        <input type="hidden" name="featured" value="0">
                        <input type="checkbox" 
                               name="featured" 
                               value="1" 
                               {{ old('featured', $portfolio->featured) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Projet mis en avant</span>
                    </label>
                </div>
                
                <div>
                    <label class="flex items-center">
                        <input type="hidden" name="actif" value="0">
                        <input type="checkbox" 
                               name="actif" 
                               value="1" 
                               {{ old('actif', $portfolio->actif) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Projet actif</span>
                    </label>
                </div>
                
                <div>
                    <label for="ordre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Ordre d'affichage
                    </label>
                    <input type="number" 
                           id="ordre" 
                           name="ordre" 
                           value="{{ old('ordre', $portfolio->ordre) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors"
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
                    <div>Créé le : {{ $portfolio->created_at->format('d/m/Y à H:i') }}</div>
                    <div>Modifié le : {{ $portfolio->updated_at->format('d/m/Y à H:i') }}</div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.portfolio.index') }}" 
                       class="px-6 py-3 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
                        Annuler
                    </a>
                    
                    <form action="{{ route('admin.portfolio.destroy', ['portfolio' => $portfolio->id]) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')"
                                class="px-6 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors">
                            Supprimer
                        </button>
                    </form>
                </div>
                
                <button type="submit" 
                        class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-xl hover:from-indigo-700 hover:to-indigo-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Prévisualisation de l'image
    document.getElementById('image_file').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            }
            
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
        }
    });
</script>
@endpush

@endsection

