@extends('layouts.admin-sidebar')

@section('title', 'Gestion "À propos" - ZEEEMAX Admin')
@section('page-title', 'Gestion "À propos"')
@section('page-description', 'Gérez le contenu de la section "À propos"')

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
                <span class="text-blue-600">À propos</span>
            </div>
            <p class="text-gray-600 dark:text-gray-300">Gérez le contenu de la section "À propos" du site</p>
        </div>
        
        <!-- Nouvelle Section Button -->
        <a href="{{ route('admin.apropos.create') }}" class="flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Nouvelle Section
        </a>
    </div>
        
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 animate-slide-up">
        <div class="glass dark:glass-dark rounded-2xl p-6">
            <div class="flex items-center">
                <div class="p-3 bg-blue-500 bg-opacity-20 rounded-xl mr-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Sections</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $apropos->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="glass dark:glass-dark rounded-2xl p-6">
            <div class="flex items-center">
                <div class="p-3 bg-green-500 bg-opacity-20 rounded-xl mr-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Avec Image</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $apropos->whereNotNull('image_url')->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="glass dark:glass-dark rounded-2xl p-6">
            <div class="flex items-center">
                <div class="p-3 bg-purple-500 bg-opacity-20 rounded-xl mr-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Dernière MAJ</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                        @if($apropos->count() > 0)
                            {{ $apropos->sortByDesc('updated_at')->first()->updated_at->diffForHumans() }}
                        @else
                            -
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Apropos Table -->
    <div class="glass dark:glass-dark rounded-2xl overflow-hidden animate-slide-up" style="animation-delay: 0.2s;">
        <!-- Table Header -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Sections "À propos"</h3>
        </div>
        
        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Titre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($apropos as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->image_url)
                                <img class="h-16 w-16 object-cover bg-gray-100 dark:bg-gray-700 rounded-lg" 
                                     src="{{ str_starts_with($item->image_url, 'http') ? $item->image_url : asset($item->image_url) }}" 
                                     alt="{{ $item->titre }}"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="h-16 w-16 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center hidden">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @else
                                <div class="h-16 w-16 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $item->titre }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 dark:text-white max-w-md truncate">
                                {{ Str::limit($item->description, 100) }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-white">{{ $item->created_at->format('d/m/Y') }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $item->created_at->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('admin.apropos.show', $item) }}" class="text-green-600 hover:text-green-900 transition-colors" title="Voir">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.apropos.edit', $item) }}" class="text-blue-600 hover:text-blue-900 transition-colors" title="Modifier">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.apropos.destroy', $item) }}" class="delete-form-{{ $item->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button" onclick="confirmDelete({{ $item->id }}, '{{ $item->titre }}', 'section')" class="text-red-600 hover:text-red-900 transition-colors" title="Supprimer">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400 mb-4">Aucune section "À propos" pour le moment</p>
                                <a href="{{ route('admin.apropos.create') }}" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-200">
                                    Créer la première section
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
                    Affichage de <span class="font-medium">{{ $apropos->count() }}</span> section(s) "À propos"
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Fonction de confirmation de suppression ultra moderne
    async function confirmDelete(id, name, type) {
        const confirmed = await window.adminConfirm.confirm(
            `Êtes-vous sûr de vouloir supprimer cette ${type} "${name}" ? Cette action est irréversible.`,
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
</script>
@endpush

@endsection

