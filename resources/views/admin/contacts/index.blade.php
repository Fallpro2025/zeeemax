@extends('layouts.admin-sidebar')

@section('title', 'Gestion des Messages - ZEEEMAX Admin')
@section('page-title')
    Gestion des Messages
    @if($messages->where('statut', 'nouveau')->count() > 0)
        <span class="ml-3 px-2 py-1 bg-red-500 text-white text-sm rounded-full animate-bounce">
            {{ $messages->where('statut', 'nouveau')->count() }}
        </span>
    @endif
@endsection
@section('page-description', 'Gérez les demandes et messages de contact')

@section('content')
<div x-data="{ selectedItems: [] }">
    
    <!-- Header Section avec actions -->
    <div class="flex items-center justify-between mb-8 animate-fade-in">
        <div>
            <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors">Dashboard</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-blue-600">Messages</span>
            </div>
            <p class="text-gray-600 dark:text-gray-300">Suivez et répondez aux demandes de contact</p>
        </div>
        
        <!-- Actions Rapides -->
        <div class="flex items-center space-x-3">
            @if($messages->where('statut', 'nouveau')->count() > 0)
            <button onclick="markAllAsRead()" class="flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-md hover:shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Marquer tout comme lu
                <span class="ml-2 px-2 py-0.5 bg-blue-500 rounded-full text-xs font-bold">
                    {{ $messages->where('statut', 'nouveau')->count() }}
                </span>
            </button>
            @endif
            <button onclick="archiveSelected()" 
                    class="flex items-center px-5 py-2.5 bg-gradient-to-r from-gray-600 to-gray-700 text-white rounded-lg hover:from-gray-700 hover:to-gray-800 transition-all duration-200 shadow-md hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:from-gray-400 disabled:to-gray-500" 
                    id="archiveSelectedBtn" 
                    disabled>
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8l6 6 6-6"></path>
                </svg>
                Archiver sélectionnés
                <span class="ml-2 px-2 py-0.5 bg-gray-500 rounded-full text-xs font-bold" id="selectedCount">0</span>
            </button>
        </div>
    </div>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 animate-slide-up">
            <div class="glass dark:glass-dark rounded-2xl p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-slate-500 bg-opacity-20 rounded-xl mr-4">
                        <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Messages</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $messages->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="glass dark:glass-dark rounded-2xl p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-red-500 bg-opacity-20 rounded-xl mr-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Non lus</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $messages->where('statut', 'nouveau')->count() }}</p>
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
                        <p class="text-sm text-gray-600 dark:text-gray-400">Traités</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $messages->where('statut', 'lu')->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="glass dark:glass-dark rounded-2xl p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-500 bg-opacity-20 rounded-xl mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8l6 6 10-10"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Cette semaine</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $messages->where('created_at', '>=', now()->subDays(7))->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Messages Table -->
        <div class="glass dark:glass-dark rounded-2xl overflow-hidden animate-slide-up" style="animation-delay: 0.2s;">
            <!-- Table Header -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                <form id="filterForm" method="GET" action="{{ route('admin.contacts.index') }}" class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Messages de Contact</h3>
                    <div class="flex items-center space-x-4">
                        <!-- Search -->
                        <div class="relative">
                            <input type="text" name="search" id="searchInput" value="{{ $search }}" placeholder="Rechercher..." class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-slate-500 focus:border-transparent">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <!-- Filter -->
                        <select name="statut" id="statutFilter" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="all" {{ $statut === 'all' ? 'selected' : '' }}>Tous les statuts</option>
                            <option value="nouveau" {{ $statut === 'nouveau' ? 'selected' : '' }}>Nouveau</option>
                            <option value="lu" {{ $statut === 'lu' ? 'selected' : '' }}>Lu</option>
                            <option value="archive" {{ $statut === 'archive' ? 'selected' : '' }}>Archivé</option>
                        </select>
                        <!-- Sort -->
                        <select name="sort_by" id="sortBy" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="created_at" {{ $sortBy === 'created_at' ? 'selected' : '' }}>Date de réception</option>
                            <option value="prenom" {{ $sortBy === 'prenom' ? 'selected' : '' }}>Prénom</option>
                            <option value="nom" {{ $sortBy === 'nom' ? 'selected' : '' }}>Nom</option>
                            <option value="email" {{ $sortBy === 'email' ? 'selected' : '' }}>Email</option>
                            <option value="updated_at" {{ $sortBy === 'updated_at' ? 'selected' : '' }}>Dernière modification</option>
                        </select>
                        <select name="sort_order" id="sortOrder" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="desc" {{ $sortOrder === 'desc' ? 'selected' : '' }}>↓ Récent</option>
                            <option value="asc" {{ $sortOrder === 'asc' ? 'selected' : '' }}>↑ Ancien</option>
                        </select>
                        <!-- Reset -->
                        @if($search || $statut !== 'all' || $sortBy !== 'created_at')
                        <a href="{{ route('admin.contacts.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition-colors">
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
                                <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-slate-600 focus:ring-slate-500" onchange="toggleAllCheckboxes(this.checked)">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Expéditeur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Sujet</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Message</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($messages as $message)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors {{ $message->statut === 'nouveau' ? 'bg-blue-50 dark:bg-blue-900/20' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" 
                                       class="message-checkbox rounded border-gray-300 text-slate-600 focus:ring-slate-500" 
                                       value="{{ $message->id }}"
                                       onchange="updateSelectedCount()">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-slate-500 to-slate-600 flex items-center justify-center text-white font-bold">
                                            {{ substr($message->prenom, 0, 1) }}{{ substr($message->nom, 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $message->prenom }} {{ $message->nom }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $message->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $message->sujet }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 dark:text-white max-w-md truncate">
                                    {{ Str::limit($message->message, 80) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $message->created_at->format('d/m/Y') }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $message->created_at->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($message->statut === 'nouveau')
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 animate-pulse">
                                        🔴 Nouveau
                                    </span>
                                @elseif($message->statut === 'lu')
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        ✅ Lu
                                    </span>
                                @else
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">
                                        📁 Archivé
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('admin.contacts.show', $message) }}" class="text-slate-600 hover:text-slate-900 transition-colors" title="Voir le message">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    @if($message->statut === 'nouveau')
                                        <button onclick="markAsRead({{ $message->id }})" class="text-green-600 hover:text-green-900 transition-colors" title="Marquer comme lu">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </button>
                                    @endif
                                    @if($message->statut !== 'archive')
                                        <button onclick="archiveMessage({{ $message->id }})" class="text-blue-600 hover:text-blue-900 transition-colors" title="Archiver">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8l6 6 10-10"></path>
                                            </svg>
                                        </button>
                                    @endif
                                    <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->sujet }}" class="text-purple-600 hover:text-purple-900 transition-colors" title="Répondre par email">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.contacts.destroy', $message) }}" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition-colors" title="Supprimer">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
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
                        Affichage de <span class="font-medium">{{ $messages->count() }}</span> message(s)
                        @if($messages->where('statut', 'nouveau')->count() > 0)
                            - <span class="font-medium text-red-600">{{ $messages->where('statut', 'nouveau')->count() }} non lu(s)</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Fonction pour marquer un message comme lu
    async function markAsRead(messageId) {
        try {
            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.content || '');
            
            const response = await fetch(`/admin/contacts/${messageId}/mark-read`, {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.status === 'success') {
                window.adminUtils.showToast('Message marqué comme lu', 'success');
                setTimeout(() => window.location.reload(), 500);
            } else {
                window.adminUtils.showToast('Erreur lors du marquage', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            window.adminUtils.showToast('Erreur de communication', 'error');
        }
    }

    // Fonction pour archiver un message
    async function archiveMessage(messageId) {
        try {
            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.content || '');
            
            const response = await fetch(`/admin/contacts/${messageId}/archive`, {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.status === 'success') {
                window.adminUtils.showToast('Message archivé', 'success');
                setTimeout(() => window.location.reload(), 500);
            } else {
                window.adminUtils.showToast('Erreur lors de l\'archivage', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            window.adminUtils.showToast('Erreur de communication', 'error');
        }
    }

    // Fonction pour marquer tous les messages comme lus
    async function markAllAsRead() {
        const confirmed = await window.adminConfirm?.confirm(
            'Êtes-vous sûr de vouloir marquer tous les messages non lus comme lus ?',
            {
                title: 'Marquer tout comme lu',
                confirmText: 'Confirmer',
                cancelText: 'Annuler',
                type: 'info'
            }
        ) || window.confirm('Êtes-vous sûr de vouloir marquer tous les messages non lus comme lus ?');
        
        if (!confirmed) return;
        
        try {
            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.content || '');
            
            const response = await fetch(`/admin/contacts/mark-all-read`, {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.status === 'success') {
                window.adminUtils.showToast(data.message || 'Messages marqués comme lus', 'success');
                setTimeout(() => window.location.reload(), 1000);
            } else {
                window.adminUtils.showToast('Erreur lors du marquage', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            window.adminUtils.showToast('Erreur de communication', 'error');
        }
    }

    // Fonction pour archiver les messages sélectionnés
    async function archiveSelected() {
        const selectedIds = getSelectedMessageIds();
        
        if (selectedIds.length === 0) {
            window.adminUtils.showToast('Veuillez sélectionner au moins un message', 'warning');
            return;
        }
        
        const confirmed = await window.adminConfirm?.confirm(
            `Êtes-vous sûr de vouloir archiver ${selectedIds.length} message(s) sélectionné(s) ?`,
            {
                title: 'Archiver les messages',
                confirmText: 'Archiver',
                cancelText: 'Annuler',
                type: 'warning'
            }
        ) || window.confirm(`Êtes-vous sûr de vouloir archiver ${selectedIds.length} message(s) sélectionné(s) ?`);
        
        if (!confirmed) return;
        
        try {
            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.content || '');
            formData.append('ids', JSON.stringify(selectedIds));
            
            const response = await fetch(`/admin/contacts/archive-selected`, {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.status === 'success') {
                window.adminUtils.showToast(data.message || 'Messages archivés', 'success');
                setTimeout(() => window.location.reload(), 1000);
            } else {
                window.adminUtils.showToast(data.message || 'Erreur lors de l\'archivage', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            window.adminUtils.showToast('Erreur de communication', 'error');
        }
    }

    // Fonction pour obtenir les IDs des messages sélectionnés
    function getSelectedMessageIds() {
        const checkboxes = document.querySelectorAll('.message-checkbox:checked');
        return Array.from(checkboxes).map(cb => parseInt(cb.value));
    }

    // Fonction pour mettre à jour le compteur de sélection
    function updateSelectedCount() {
        const count = getSelectedMessageIds().length;
        const countSpan = document.getElementById('selectedCount');
        const archiveBtn = document.getElementById('archiveSelectedBtn');
        
        if (countSpan) {
            countSpan.textContent = count;
            if (count > 0) {
                countSpan.classList.remove('bg-gray-500');
                countSpan.classList.add('bg-orange-500');
            } else {
                countSpan.classList.remove('bg-orange-500');
                countSpan.classList.add('bg-gray-500');
            }
        }
        
        if (archiveBtn) {
            archiveBtn.disabled = count === 0;
        }
    }

    // Fonction pour cocher/décocher toutes les checkboxes
    function toggleAllCheckboxes(checked) {
        const checkboxes = document.querySelectorAll('.message-checkbox');
        checkboxes.forEach(cb => {
            cb.checked = checked;
        });
        updateSelectedCount();
    }

    // Initialisation au chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser le compteur de sélection
        updateSelectedCount();
        
        const filterForm = document.getElementById('filterForm');
        const searchInput = document.getElementById('searchInput');
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


