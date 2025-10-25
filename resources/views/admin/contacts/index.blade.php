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
<div x-data="{ selectedItems: [] }" class="p-6">
    
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
        <div class="flex items-center space-x-2">
            <button class="px-4 py-2 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-800 transition-colors">
                Marquer tout comme lu
            </button>
            <button class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                Archiver sélectionnés
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
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Messages de Contact</h3>
                    <div class="flex items-center space-x-4">
                        <!-- Search -->
                        <div class="relative">
                            <input type="text" placeholder="Rechercher..." class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-slate-500 focus:border-transparent">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <!-- Filter -->
                        <select class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option>Tous les statuts</option>
                            <option>Nouveau</option>
                            <option>Lu</option>
                            <option>Archivé</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Table Content -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                <input type="checkbox" class="rounded border-gray-300 text-slate-600 focus:ring-slate-500">
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
                                <input type="checkbox" class="rounded border-gray-300 text-slate-600 focus:ring-slate-500">
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
    function markAsRead(messageId) {
        window.adminUtils.request(`/admin/contacts/${messageId}/mark-read`, {
            method: 'POST'
        })
        .then(data => {
            if (data.status === 'success') {
                window.location.reload();
            } else {
                window.adminUtils.showToast('Erreur lors du marquage', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            window.adminUtils.showToast('Erreur de communication', 'error');
        });
    }

    function archiveMessage(messageId) {
        window.adminUtils.request(`/admin/contacts/${messageId}/archive`, {
            method: 'POST'
        })
        .then(data => {
            if (data.status === 'success') {
                window.location.reload();
            } else {
                window.adminUtils.showToast('Erreur lors de l\'archivage', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            window.adminUtils.showToast('Erreur de communication', 'error');
        });
    }
</script>
@endpush

