@extends('layouts.admin-sidebar')

@section('title', 'Gestion du Portfolio - ZEEEMAX Admin')
@section('page-title', 'Gestion du Portfolio')  
@section('page-description', 'Showcase de vos projets et réalisations')

@php
    // Variables de recherche et filtres
    $search = $search ?? '';
    $categorie = $categorie ?? 'all';
    $statut = $statut ?? 'all';
    $sortBy = $sortBy ?? 'ordre';
    $sortOrder = $sortOrder ?? 'asc';
@endphp

@section('content')
<div x-data="{ selectedItems: [] }" >
    
    <!-- Header Section avec bouton d'action -->
    <div class="flex items-center justify-between mb-8 animate-fade-in">
        <div>
            <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors">Dashboard</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-blue-600">Portfolio</span>
            </div>
            <p class="text-gray-600 dark:text-gray-300">Présentez vos meilleurs projets et réalisations</p>
        </div>
        
        <!-- Nouveau Projet Button -->
        <a href="{{ route('admin.portfolio.create') }}" class="flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-xl hover:from-indigo-700 hover:to-indigo-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Nouveau Projet
        </a>
    </div>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 animate-slide-up">
        <div class="glass dark:glass-dark rounded-2xl p-6">
            <div class="flex items-center">
                <div class="p-3 bg-indigo-500 bg-opacity-20 rounded-xl mr-4">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Résultats</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $portfolioItems->count() }}</p>
                    @if($search || $categorie !== 'all' || $statut !== 'all' || $sortBy !== 'ordre')
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Résultats filtrés</p>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="glass dark:glass-dark rounded-2xl p-6">
            <div class="flex items-center">
                <div class="p-3 bg-green-500 bg-opacity-20 rounded-xl mr-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Actifs</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $portfolioItems->where('actif', true)->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="glass dark:glass-dark rounded-2xl p-6">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-500 bg-opacity-20 rounded-xl mr-4">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Mis en avant</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $portfolioItems->where('featured', true)->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="glass dark:glass-dark rounded-2xl p-6">
            <div class="flex items-center">
                <div class="p-3 bg-blue-500 bg-opacity-20 rounded-xl mr-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Catégories</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $portfolioItems->pluck('categorie')->unique()->count() }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Portfolio Table -->
    <div class="glass dark:glass-dark rounded-2xl overflow-hidden animate-slide-up" style="animation-delay: 0.2s;">
        <!-- Table Header -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                <form id="filterForm" method="GET" action="{{ route('admin.portfolio.index') }}" class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Liste des Projets</h3>
                    <div class="flex items-center space-x-4">
                        <!-- Search -->
                        <div class="relative">
                            <input type="text" name="search" id="searchInput" value="{{ $search }}" placeholder="Rechercher..." class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <!-- Filter Catégorie -->
                        <select name="categorie" id="categorieFilter" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="all" {{ $categorie === 'all' ? 'selected' : '' }}>Toutes les catégories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ $categorie === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        <!-- Filter Statut -->
                        <select name="statut" id="statutFilter" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="all" {{ $statut === 'all' ? 'selected' : '' }}>Tous les statuts</option>
                            <option value="actif" {{ $statut === 'actif' ? 'selected' : '' }}>Actifs uniquement</option>
                            <option value="inactif" {{ $statut === 'inactif' ? 'selected' : '' }}>Inactifs uniquement</option>
                        </select>
                        <!-- Sort -->
                        <select name="sort_by" id="sortBy" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="ordre" {{ $sortBy === 'ordre' ? 'selected' : '' }}>Ordre</option>
                            <option value="titre" {{ $sortBy === 'titre' ? 'selected' : '' }}>Titre</option>
                            <option value="categorie" {{ $sortBy === 'categorie' ? 'selected' : '' }}>Catégorie</option>
                            <option value="created_at" {{ $sortBy === 'created_at' ? 'selected' : '' }}>Date de création</option>
                            <option value="updated_at" {{ $sortBy === 'updated_at' ? 'selected' : '' }}>Dernière modification</option>
                        </select>
                        <select name="sort_order" id="sortOrder" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="asc" {{ $sortOrder === 'asc' ? 'selected' : '' }}>↑ Croissant</option>
                            <option value="desc" {{ $sortOrder === 'desc' ? 'selected' : '' }}>↓ Décroissant</option>
                        </select>
                        <!-- Reset -->
                        @if($search || $categorie !== 'all' || $statut !== 'all' || $sortBy !== 'ordre')
                        <a href="{{ route('admin.portfolio.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition-colors">
                            Réinitialiser
                        </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Projet</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Catégorie</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Technologies</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($portfolioItems as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if(!str_contains($item->image_url, 'via.placeholder'))
                                    <div class="flex-shrink-0 h-16 w-16">
                                        <img class="h-16 w-16 rounded-lg object-cover" src="{{ str_starts_with($item->image_url, 'http') ? $item->image_url : asset($item->image_url) }}" alt="{{ $item->titre }}">
                                    </div>
                                    @endif
                                    <div class="{{ !str_contains($item->image_url, 'via.placeholder') ? 'ml-4' : '' }}">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $item->titre }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $item->slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                    {{ $item->categorie }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @if($item->technologies)
                                        @foreach(array_slice($item->technologies, 0, 3) as $tech)
                                            <span class="px-2 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded">{{ $tech }}</span>
                                        @endforeach
                                        @if(count($item->technologies) > 3)
                                            <span class="px-2 py-1 text-xs bg-gray-200 dark:bg-gray-600 text-gray-600 dark:text-gray-400 rounded">+{{ count($item->technologies) - 3 }}</span>
                                        @endif
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    @if($item->actif)
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            Actif
                                        </span>
                                    @else
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                            Inactif
                                        </span>
                                    @endif
                                    @if($item->featured)
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                            ⭐ Featured
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('admin.portfolio.edit', ['portfolio' => $item->id]) }}" class="text-indigo-600 hover:text-indigo-900 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.portfolio.show', ['portfolio' => $item->id]) }}" class="text-green-600 hover:text-green-900 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    @if($item->lien_demo)
                                        <a href="{{ $item->lien_demo }}" target="_blank" class="text-blue-600 hover:text-blue-900 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                        </a>
                                    @endif
                                    <form method="POST" action="{{ route('admin.portfolio.destroy', ['portfolio' => $item->id]) }}" class="delete-form-{{ $item->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" onclick="confirmDelete({{ $item->id }}, '{{ $item->titre }}', 'portfolio')" class="text-red-600 hover:text-red-900 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Table Footer -->
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-700 dark:text-gray-300">
                    Affichage de <span class="font-medium">{{ $portfolioItems->count() }}</span> projet(s)
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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

    // Fonction de confirmation de suppression moderne
    async function confirmDelete(id, name, type) {
        const confirmed = await window.adminConfirm.confirm(
            `Êtes-vous sûr de vouloir supprimer "${name}" ? Cette action est irréversible.`,
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
            const form = document.querySelector(`.delete-form-${id}`);
            window.adminAlert.info('Suppression en cours...');
            form.submit();
        }
    }

    // Recherche et filtres avec soumission automatique
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.getElementById('filterForm');
        const searchInput = document.getElementById('searchInput');
        const categorieFilter = document.getElementById('categorieFilter');
        const statutFilter = document.getElementById('statutFilter');
        const sortBy = document.getElementById('sortBy');
        const sortOrder = document.getElementById('sortOrder');
        
        // Fonction pour soumettre le formulaire avec debounce
        const debouncedSubmit = window.adminUtils.debounce(function() {
            filterForm.submit();
        }, 500);
        
        // Recherche avec debounce
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                debouncedSubmit();
            });
        }
        
        // Filtres et tris : soumission immédiate
        [categorieFilter, statutFilter, sortBy, sortOrder].forEach(element => {
            if (element) {
                element.addEventListener('change', function() {
                    filterForm.submit();
                });
            }
        });
    });
</script>
@endpush


