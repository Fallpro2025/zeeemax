@extends('layouts.admin-sidebar')

@section('title', 'Créer un Projet - ZEEEMAX Admin')
@section('page-title', 'Créer un Projet')
@section('page-description', 'Ajoutez un nouveau projet à votre portfolio')

@section('content')
<div >
    
    <!-- Header Section avec navigation -->
    <div class="flex items-center justify-between mb-8">
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
                <span class="text-blue-600">Créer</span>
            </div>
            <p class="text-gray-600 dark:text-gray-300">Ajoutez un nouveau projet à votre portfolio</p>
        </div>
        
        <!-- Retour Button -->
        <a href="{{ route('admin.portfolio.index') }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Retour à la liste
        </a>
    </div>

    <!-- Formulaire -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <form action="{{ route('admin.portfolio.store') }}" method="POST" class="space-y-6 p-8">
            @csrf
            
            <!-- Titre et Slug -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="titre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Titre du projet *
                    </label>
                    <input type="text" 
                           id="titre" 
                           name="titre" 
                           value="{{ old('titre') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors"
                           placeholder="Ex: Site E-commerce Moderne"
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
                           value="{{ old('slug') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors"
                           placeholder="site-ecommerce-moderne">
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
                        <option value="">Choisir une catégorie</option>
                        <option value="web" {{ old('categorie') == 'web' ? 'selected' : '' }}>Développement Web</option>
                        <option value="mobile" {{ old('categorie') == 'mobile' ? 'selected' : '' }}>Application Mobile</option>
                        <option value="design" {{ old('categorie') == 'design' ? 'selected' : '' }}>Design & Branding</option>
                        <option value="marketing" {{ old('categorie') == 'marketing' ? 'selected' : '' }}>Marketing Digital</option>
                        <option value="ecommerce" {{ old('categorie') == 'ecommerce' ? 'selected' : '' }}>E-commerce</option>
                        <option value="autre" {{ old('categorie') == 'autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                    @error('categorie')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="image_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        URL de l'image *
                    </label>
                    <input type="url" 
                           id="image_url" 
                           name="image_url" 
                           value="{{ old('image_url') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors"
                           placeholder="https://exemple.com/image.jpg"
                           required>
                    @error('image_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
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
                          placeholder="Décrivez votre projet, les objectifs, les défis relevés..."
                          required>{{ old('description') }}</textarea>
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
                       value="{{ old('technologies') }}"
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors"
                       placeholder="Laravel, Vue.js, Tailwind CSS, MySQL">
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
                           value="{{ old('lien_demo') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors"
                           placeholder="https://demo.exemple.com">
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
                           value="{{ old('lien_github') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors"
                           placeholder="https://github.com/user/projet">
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
                               {{ old('featured') ? 'checked' : '' }}
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
                               {{ old('actif', true) ? 'checked' : '' }}
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
                           value="{{ old('ordre', 0) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors"
                           min="0">
                    @error('ordre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.portfolio.index') }}" 
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
                            class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-xl hover:from-indigo-700 hover:to-indigo-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                        Créer le projet
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Auto-génération du slug depuis le titre
    document.getElementById('titre').addEventListener('input', function() {
        const titre = this.value;
        const slug = titre
            .toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim('-');
        
        document.getElementById('slug').value = slug;
    });
</script>
@endpush

