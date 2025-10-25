@extends('layouts.admin-sidebar')

@section('title', 'Service: ' . $service->titre . ' - ZEEEMAX Admin')
@section('page-title', 'Détails du Service')
@section('page-description', 'Consultez les informations complètes du service')

@section('content')
<div class="p-6">
    
    <!-- Header Section avec navigation -->
    <div class="flex items-center justify-between mb-8 animate-fade-in">
        <div>
            <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors">Dashboard</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('admin.services.index') }}" class="hover:text-blue-600 transition-colors">Services</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-blue-600">{{ $service->titre }}</span>
            </div>
            <div class="flex items-center space-x-3">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $service->titre }}</h1>
                @if($service->actif)
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
        
        <!-- Actions rapides -->
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.services.edit', $service) }}" class="flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Modifier
            </a>
            <a href="{{ route('admin.services.index') }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour à la liste
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Contenu principal -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Informations générales -->
            <div class="glass dark:glass-dark rounded-2xl p-8 animate-slide-up">
                <div class="flex items-start space-x-6">
                    @if($service->icone_svg)
                        <div class="flex-shrink-0 w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center">
                            <div class="w-8 h-8 text-blue-600">
                                {!! $service->icone_svg !!}
                            </div>
                        </div>
                    @endif
                    
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ $service->titre }}</h2>
                        
                        <div class="prose dark:prose-invert max-w-none">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $service->description }}</p>
                        </div>
                        
                        <div class="mt-6 flex items-center space-x-4">
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Slug : <code class="ml-1 px-2 py-1 bg-gray-100 dark:bg-gray-800 rounded">{{ $service->slug }}</code>
                            </div>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                </svg>
                                Ordre : {{ $service->ordre }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($service->icone_svg)
            <!-- Aperçu de l'icône -->
            <div class="glass dark:glass-dark rounded-2xl p-8 animate-slide-up" style="animation-delay: 0.1s;">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Code de l'icône</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Aperçu</h4>
                        <div class="flex items-center justify-center h-32 bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl">
                            <div class="w-12 h-12 text-blue-600">
                                {!! $service->icone_svg !!}
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Code SVG</h4>
                        <div class="bg-gray-900 rounded-xl p-4 overflow-x-auto">
                            <code class="text-green-400 text-sm font-mono break-all">{{ $service->icone_svg }}</code>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar avec métadonnées -->
        <div class="space-y-6">
            
            <!-- Statut et actions -->
            <div class="glass dark:glass-dark rounded-2xl p-6 animate-slide-up" style="animation-delay: 0.2s;">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Actions rapides</h3>
                
                <div class="space-y-3">
                    <button onclick="toggleService({{ $service->id }})" 
                            class="w-full flex items-center justify-center px-4 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                        </svg>
                        {{ $service->actif ? 'Désactiver' : 'Activer' }}
                    </button>
                    
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce service ?')"
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
            <div class="glass dark:glass-dark rounded-2xl p-6 animate-slide-up" style="animation-delay: 0.3s;">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informations</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">ID</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">#{{ $service->id }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Statut</span>
                        <span class="text-sm font-medium {{ $service->actif ? 'text-green-600' : 'text-red-600' }}">
                            {{ $service->actif ? 'Actif' : 'Inactif' }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Ordre</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $service->ordre }}</span>
                    </div>
                    
                    <hr class="border-gray-200 dark:border-gray-700">
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Créé le</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $service->created_at->format('d/m/Y') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Modifié le</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $service->updated_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Navigation entre services -->
            <div class="glass dark:glass-dark rounded-2xl p-6 animate-slide-up" style="animation-delay: 0.4s;">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Navigation</h3>
                
                <div class="space-y-3">
                    @php
                        $previousService = \App\Models\Service::where('id', '<', $service->id)->orderBy('id', 'desc')->first();
                        $nextService = \App\Models\Service::where('id', '>', $service->id)->orderBy('id', 'asc')->first();
                    @endphp
                    
                    @if($previousService)
                        <a href="{{ route('admin.services.show', $previousService) }}" 
                           class="flex items-center p-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            <span class="text-sm">{{ Str::limit($previousService->titre, 25) }}</span>
                        </a>
                    @endif
                    
                    @if($nextService)
                        <a href="{{ route('admin.services.show', $nextService) }}" 
                           class="flex items-center justify-between p-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                            <span class="text-sm">{{ Str::limit($nextService->titre, 25) }}</span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @endif
                    
                    @if(!$previousService && !$nextService)
                        <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">
                            Aucun autre service
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Version optimisée avec utils communs
    function toggleService(serviceId) {
        window.adminUtils.request(`/admin/services/${serviceId}/toggle`, {
            method: 'POST'
        })
        .then(data => {
            if (data.status === 'success') {
                window.location.reload();
            } else {
                window.adminUtils.showToast('Erreur lors de la modification du service', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            window.adminUtils.showToast('Erreur de communication', 'error');
        });
    }
</script>
@endpush
