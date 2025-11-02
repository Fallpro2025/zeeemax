@extends('layouts.admin-sidebar')

@section('title', 'Gestion des Clients - ZEEEMAX Admin')
@section('page-title', 'Gestion des Clients')  
@section('page-description', 'Gérez les clients qui vous font confiance')

@php
    $search = $search ?? '';
    $statut = $statut ?? 'all';
    $sortBy = $sortBy ?? 'ordre';
    $sortOrder = $sortOrder ?? 'asc';
@endphp

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
                <span class="text-blue-600">Clients</span>
            </div>
            <p class="text-gray-600 dark:text-gray-300">Gérez les clients qui vous font confiance</p>
        </div>
        
        <!-- Nouveau Client Button -->
        <a href="{{ route('admin.clients.create') }}" class="flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Nouveau Client
        </a>
    </div>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 animate-slide-up">
        <div class="glass dark:glass-dark rounded-2xl p-6">
            <div class="flex items-center">
                <div class="p-3 bg-blue-500 bg-opacity-20 rounded-xl mr-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Résultats</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $clients->count() }}</p>
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
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $clients->where('actif', true)->count() }}</p>
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
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $clients->where('actif', false)->count() }}</p>
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
                        @if($clients->count() > 0)
                            {{ $clients->sortByDesc('updated_at')->first()->updated_at->diffForHumans() }}
                        @else
                            -
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Clients Table -->
    <div class="glass dark:glass-dark rounded-2xl overflow-hidden animate-slide-up" style="animation-delay: 0.2s;">
        <!-- Table Header -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
            <form id="filterForm" method="GET" action="{{ route('admin.clients.index') }}" class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Liste des Clients</h3>
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
                        <option value="nom" {{ $sortBy === 'nom' ? 'selected' : '' }}>Nom</option>
                        <option value="type" {{ $sortBy === 'type' ? 'selected' : '' }}>Type</option>
                        <option value="created_at" {{ $sortBy === 'created_at' ? 'selected' : '' }}>Date de création</option>
                        <option value="updated_at" {{ $sortBy === 'updated_at' ? 'selected' : '' }}>Dernière modification</option>
                    </select>
                    <select name="sort_order" id="sortOrder" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        <option value="asc" {{ $sortOrder === 'asc' ? 'selected' : '' }}>↑ Croissant</option>
                        <option value="desc" {{ $sortOrder === 'desc' ? 'selected' : '' }}>↓ Décroissant</option>
                    </select>
                    <!-- Reset -->
                    @if($search || $statut !== 'all' || $sortBy !== 'ordre')
                    <a href="{{ route('admin.clients.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition-colors">
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Ordre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($clients as $client)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($client->logo_url)
                                <div class="flex-shrink-0 w-12 h-12 rounded-full overflow-hidden border-2 border-gray-200 dark:border-gray-700 mr-4">
                                    <img src="{{ str_starts_with($client->logo_url, 'http') ? $client->logo_url : asset($client->logo_url) }}" 
                                         alt="{{ $client->nom }}" 
                                         class="w-full h-full object-cover">
                                </div>
                                @else
                                <div class="flex-shrink-0 w-12 h-12 bg-black rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                                    {{ strtoupper(substr($client->nom, 0, 1)) }}
                                </div>
                                @endif
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $client->nom }}</div>
                                    @if($client->type)
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $client->type }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-white">{{ $client->type ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($client->actif)
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    Actif
                                </span>
                            @else
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                    Inactif
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $client->ordre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('admin.clients.edit', $client) }}" class="text-blue-600 hover:text-blue-900 transition-colors" title="Éditer">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.clients.show', $client) }}" class="text-green-600 hover:text-green-900 transition-colors" title="Voir">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <button onclick="toggleClient({{ $client->id }})" class="text-purple-600 hover:text-purple-900 transition-colors" title="Activer/Désactiver">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                    </svg>
                                </button>
                                <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" class="inline delete-form-{{ $client->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $client->id }}, '{{ $client->nom }}', 'clients')" class="text-red-600 hover:text-red-900 transition-colors" title="Supprimer">
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
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Aucun client trouvé</h3>
                                <p class="text-gray-500 dark:text-gray-400 mb-4">Commencez par créer votre premier client.</p>
                                <a href="{{ route('admin.clients.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    Créer un client
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
                    @if($clients->count() > 0)
                        Affichage de <span class="font-medium">{{ $clients->count() }}</span> client(s)
                    @else
                        Aucun client trouvé
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-submit form on filter change
    document.getElementById('statutFilter')?.addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });
    
    document.getElementById('sortBy')?.addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });
    
    document.getElementById('sortOrder')?.addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });

    // Debounce search input
    let searchTimeout;
    document.getElementById('searchInput')?.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            if (this.value.length === 0 || this.value.length >= 3) {
                document.getElementById('filterForm').submit();
            }
        }, 500);
    });

    function toggleClient(clientId) {
        window.adminUtils.request(`/admin/clients/${clientId}/toggle`, {
            method: 'POST'
        })
        .then(data => {
            if (data.status === 'success') {
                window.adminAlert.success('Statut du client modifié avec succès !');
                setTimeout(() => window.location.reload(), 500);
            } else {
                window.adminAlert.error('Erreur lors de la modification du client');
            }
        })
        .catch(error => {
            window.adminAlert.error('Erreur lors de la modification du client');
        });
    }

    function confirmDelete(clientId, nom, type) {
        if (confirm(`Êtes-vous sûr de vouloir supprimer le client "${nom}" ? Cette action est irréversible.`)) {
            document.querySelector(`.delete-form-${clientId}`).submit();
        }
    }
</script>
@endpush

