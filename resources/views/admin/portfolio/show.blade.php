@extends('layouts.admin-sidebar')

@section('title', 'Projet: ' . $portfolioItem->titre . ' - ZEEEMAX Admin')
@section('page-title', 'Détails du Projet')
@section('page-description', 'Consultez les informations complètes du projet')

@section('content')
<div class="p-6">
    
    <!-- Header Section -->
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
                <span class="text-blue-600">{{ $portfolioItem->titre }}</span>
            </div>
            <div class="flex items-center space-x-3">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $portfolioItem->titre }}</h1>
                @if($portfolioItem->featured)
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 text-sm font-medium rounded-full">
                        ⭐ Featured
                    </span>
                @endif
                @if($portfolioItem->actif)
                    <span class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 text-sm font-medium rounded-full">
                        Actif
                    </span>
                @else
                    <span class="px-3 py-1 bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 text-sm font-medium rounded-full">
                        Inactif
                    </span>
                @endif
            </div>
        </div>
        
        <!-- Actions -->
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.portfolio.edit', $portfolioItem) }}" class="flex items-center px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Modifier
            </a>
            <a href="{{ route('admin.portfolio.index') }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Contenu principal -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Image et infos principales -->
            <div class="glass dark:glass-dark rounded-2xl overflow-hidden animate-slide-up">
                @if($portfolioItem->image_url)
                    <div class="aspect-video bg-gray-100 dark:bg-gray-800">
                        <img src="{{ $portfolioItem->image_url }}" 
                             alt="{{ $portfolioItem->titre }}"
                             class="w-full h-full object-cover">
                    </div>
                @endif
                
                <div class="p-8">
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-3 py-1 bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200 text-sm font-medium rounded-full">
                            {{ ucfirst($portfolioItem->categorie) }}
                        </span>
                        <div class="flex items-center space-x-3">
                            @if($portfolioItem->lien_demo)
                                <a href="{{ $portfolioItem->lien_demo }}" 
                                   target="_blank"
                                   class="flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    Voir la démo
                                </a>
                            @endif
                            @if($portfolioItem->lien_github)
                                <a href="{{ $portfolioItem->lien_github }}" 
                                   target="_blank"
                                   class="flex items-center px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Code source
                                </a>
                            @endif
                        </div>
                    </div>
                    
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ $portfolioItem->titre }}</h2>
                    
                    <div class="prose dark:prose-invert max-w-none">
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $portfolioItem->description }}</p>
                    </div>
                    
                    @if($portfolioItem->technologies)
                        <div class="mt-6">
                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Technologies utilisées</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach((is_array($portfolioItem->technologies) ? $portfolioItem->technologies : explode(',', $portfolioItem->technologies)) as $tech)
                                    <span class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm rounded-full">
                                        {{ trim($tech) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            
            <!-- Actions rapides -->
            <div class="glass dark:glass-dark rounded-2xl p-6 animate-slide-up" style="animation-delay: 0.1s;">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Actions</h3>
                
                <div class="space-y-3">
                    <button onclick="toggleProject({{ $portfolioItem->id }})" 
                            class="w-full flex items-center justify-center px-4 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        {{ $portfolioItem->featured ? 'Retirer des favoris' : 'Mettre en avant' }}
                    </button>
                    
                    <form action="{{ route('admin.portfolio.destroy', $portfolioItem) }}" method="POST" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')"
                                class="w-full flex items-center justify-center px-4 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>

            <!-- Métadonnées -->
            <div class="glass dark:glass-dark rounded-2xl p-6 animate-slide-up" style="animation-delay: 0.2s;">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informations</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">ID</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">#{{ $portfolioItem->id }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Catégorie</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst($portfolioItem->categorie) }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Statut</span>
                        <span class="text-sm font-medium {{ $portfolioItem->actif ? 'text-green-600' : 'text-red-600' }}">
                            {{ $portfolioItem->actif ? 'Actif' : 'Inactif' }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Mis en avant</span>
                        <span class="text-sm font-medium {{ $portfolioItem->featured ? 'text-yellow-600' : 'text-gray-500' }}">
                            {{ $portfolioItem->featured ? 'Oui' : 'Non' }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Ordre</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $portfolioItem->ordre }}</span>
                    </div>
                    
                    <hr class="border-gray-200 dark:border-gray-700">
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Créé le</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $portfolioItem->created_at->format('d/m/Y') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Modifié le</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $portfolioItem->updated_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function toggleProject(projectId) {
        window.adminUtils.request(`/admin/portfolio/${projectId}/toggle`, {
            method: 'POST'
        })
        .then(data => {
            if (data.status === 'success') {
                window.location.reload();
            } else {
                window.adminUtils.showToast('Erreur lors de la modification du projet', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            window.adminUtils.showToast('Erreur de communication', 'error');
        });
    }
</script>
@endpush
