@extends('layouts.admin-sidebar')

@section('title', 'Gestion des Services - ZEEEMAX Admin')
@section('page-title', 'Gestion des Services')  
@section('page-description', 'Gérez et organisez vos services')

@php
    // Variables de recherche et filtres (fournies par le contrôleur ou par défaut)
    $search = $search ?? '';
    $statut = $statut ?? 'all';
    $sortBy = $sortBy ?? 'ordre';
    $sortOrder = $sortOrder ?? 'asc';
@endphp

@section('content')
<div x-data="{ selectedServices: [] }">
    
    <!-- Header Section avec bouton d'action -->
    <div class="flex items-center justify-between mb-8 animate-fade-in">
        <div>
            <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors">Dashboard</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-blue-600">Services</span>
            </div>
            <p class="text-gray-600 dark:text-gray-300">Gérez et organisez vos services</p>
        </div>
        
        <!-- Nouveau Service Button -->
        <a href="{{ route('admin.services.create') }}" class="flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Nouveau Service
        </a>
    </div>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 animate-slide-up">
            <div class="glass dark:glass-dark rounded-2xl p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-500 bg-opacity-20 rounded-xl mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Résultats</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $services->count() }}</p>
                        @if($search || $statut !== 'all')
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
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $services->where('actif', true)->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="glass dark:glass-dark rounded-2xl p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-500 bg-opacity-20 rounded-xl mr-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Inactifs</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $services->where('actif', false)->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="glass dark:glass-dark rounded-2xl p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-orange-500 bg-opacity-20 rounded-xl mr-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Dernière MAJ</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">
                            @if($services->count() > 0)
                                {{ $services->sortByDesc('updated_at')->first()->updated_at->diffForHumans() }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Services Table -->
        <div class="glass dark:glass-dark rounded-2xl overflow-hidden animate-slide-up" style="animation-delay: 0.2s;">
            <!-- Table Header -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                <form id="filterForm" method="GET" action="{{ route('admin.services.index') }}" class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Liste des Services</h3>
                    <div class="flex items-center space-x-4">
                        <!-- Search -->
                        <div class="relative">
                            <input type="text" name="search" id="searchInput" value="{{ $search }}" placeholder="Rechercher..." class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <!-- Filter -->
                        <select name="statut" id="statutFilter" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="all" {{ $statut === 'all' ? 'selected' : '' }}>Tous les statuts</option>
                            <option value="actif" {{ $statut === 'actif' ? 'selected' : '' }}>Actifs uniquement</option>
                            <option value="inactif" {{ $statut === 'inactif' ? 'selected' : '' }}>Inactifs uniquement</option>
                        </select>
                        <!-- Sort -->
                        <select name="sort_by" id="sortBy" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="ordre" {{ $sortBy === 'ordre' ? 'selected' : '' }}>Ordre</option>
                            <option value="titre" {{ $sortBy === 'titre' ? 'selected' : '' }}>Titre</option>
                            <option value="created_at" {{ $sortBy === 'created_at' ? 'selected' : '' }}>Date de création</option>
                            <option value="updated_at" {{ $sortBy === 'updated_at' ? 'selected' : '' }}>Dernière modification</option>
                        </select>
                        <select name="sort_order" id="sortOrder" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="asc" {{ $sortOrder === 'asc' ? 'selected' : '' }}>↑ Croissant</option>
                            <option value="desc" {{ $sortOrder === 'desc' ? 'selected' : '' }}>↓ Décroissant</option>
                        </select>
                        <!-- Reset -->
                        @if($search || $statut !== 'all' || $sortBy !== 'ordre')
                        <a href="{{ route('admin.services.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition-colors">
                            Réinitialiser
                        </a>
                        @endif
                    </div>
                </form>
            </div>
            
            <!-- Table Content -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Service</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Ordre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($services as $service)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="{{ $service->id }}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg mr-4 flex items-center justify-center admin-icon">
                                        @if($service->icone_svg)
                                            {!! $service->getIcone() !!}
                                        @else
                                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $service->titre }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $service->slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 dark:text-white max-w-xs truncate">
                                    {{ Str::limit($service->description, 80) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($service->actif)
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        Actif
                                    </span>
                                @else
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                        Inactif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $service->ordre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('admin.services.edit', $service) }}" class="text-blue-600 hover:text-blue-900 transition-colors" title="Éditer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.services.show', $service) }}" class="text-green-600 hover:text-green-900 transition-colors" title="Voir">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <button onclick="toggleService({{ $service->id }})" class="text-purple-600 hover:text-purple-900 transition-colors" title="Activer/Désactiver">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                        </svg>
                                    </button>
                                    <form method="POST" action="{{ route('admin.services.destroy', $service) }}" class="inline delete-form-{{ $service->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $service->id }}, '{{ $service->titre }}', 'services')" class="text-red-600 hover:text-red-900 transition-colors" title="Supprimer">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Aucun service trouvé</h3>
                                    <p class="text-gray-500 dark:text-gray-400 mb-4">Commencez par créer votre premier service.</p>
                                    <a href="{{ route('admin.services.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                        Créer un service
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Table Footer -->
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700 dark:text-gray-300">
                        @if($services->count() > 0)
                            Affichage de <span class="font-medium">{{ $services->count() }}</span> service(s)
                        @else
                            Aucun service trouvé
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
    <!-- Bulk Actions (if any selected) -->
    <div x-show="selectedServices.length > 0" class="mt-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 px-6 py-4" style="display: none;">
            <div class="flex items-center space-x-4">
                <span class="text-sm font-medium text-gray-900 dark:text-white" x-text="selectedServices.length + ' service(s) sélectionné(s)'"></span>
                <button class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                    Supprimer
                </button>
                <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                    Désactiver
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Version optimisée avec utils communs
    function toggleService(serviceId) {
        window.adminUtils.request(`/admin/services/${serviceId}/toggle`, {
            method: 'POST'
        })
        .then(data => {
            if (data.status === 'success') {
                window.adminAlert.success('Statut du service modifié avec succès !');
                setTimeout(() => window.location.reload(), 500);
            } else {
                window.adminAlert.error('Erreur lors de la modification du service');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            window.adminAlert.error('Erreur de communication');
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
        const statutFilter = document.getElementById('statutFilter');
        const sortBy = document.getElementById('sortBy');
        const sortOrder = document.getElementById('sortOrder');
        
        // Fonction pour soumettre le formulaire avec debounce
        const debouncedSubmit = window.adminUtils.debounce(function() {
            filterForm.submit();
        }, 500);
        
        // Recherche avec debounce (pas de soumission à chaque caractère)
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                // Mettre une icône de chargement visuel
                const icon = this.nextElementSibling;
                if (icon) {
                    icon.classList.add('animate-spin');
                }
                debouncedSubmit();
            });
        }
        
        // Filtres et tris : soumission immédiate
        [statutFilter, sortBy, sortOrder].forEach(element => {
            if (element) {
                element.addEventListener('change', function() {
                    filterForm.submit();
                });
            }
        });
    });
</script>
@endpush

