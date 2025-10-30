@extends('layouts.admin-sidebar')

@section('title', 'Section "À propos": ' . $apropos->titre . ' - ZEEEMAX Admin')
@section('page-title', 'Détails de la Section "À propos"')
@section('page-description', 'Consultez les informations de la section')

@section('content')
<div>
    
    <!-- Header -->
    <div class="flex items-center justify-between mb-8 animate-fade-in">
        <div>
            <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors">Dashboard</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('admin.apropos.index') }}" class="hover:text-blue-600 transition-colors">À propos</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-blue-600">{{ $apropos->titre }}</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $apropos->titre }}</h1>
        </div>
        
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.apropos.edit', $apropos) }}" class="flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Modifier
            </a>
            <a href="{{ route('admin.apropos.index') }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">
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
            
            <!-- Section À propos -->
            <div class="glass dark:glass-dark rounded-2xl p-8 animate-slide-up">
                @if($apropos->image_url)
                    <div class="mb-6">
                        <img src="{{ str_starts_with($apropos->image_url, 'http') ? $apropos->image_url : asset($apropos->image_url) }}" 
                             alt="{{ $apropos->titre }}"
                             class="w-full h-64 object-cover rounded-xl"
                             onerror="this.style.display='none'">
                    </div>
                @endif
                
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ $apropos->titre }}</h2>
                
                <div class="prose dark:prose-invert max-w-none">
                    <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-6 border-l-4 border-blue-500">
                        <p class="text-gray-900 dark:text-white leading-relaxed whitespace-pre-wrap">{{ $apropos->description }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            
            <!-- Actions -->
            <div class="glass dark:glass-dark rounded-2xl p-6 animate-slide-up" style="animation-delay: 0.1s;">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Actions</h3>
                
                <div class="space-y-3">
                    <a href="{{ route('admin.apropos.edit', $apropos) }}" 
                       class="w-full flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Modifier
                    </a>
                    
                    <form action="{{ route('admin.apropos.destroy', $apropos) }}" method="POST" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette section ?')"
                                class="w-full flex items-center justify-center px-4 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>

            <!-- Informations -->
            <div class="glass dark:glass-dark rounded-2xl p-6 animate-slide-up" style="animation-delay: 0.2s;">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informations</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">ID</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">#{{ $apropos->id }}</span>
                    </div>
                    
                    <hr class="border-gray-200 dark:border-gray-700">
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Créé le</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $apropos->created_at->format('d/m/Y') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Modifié le</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $apropos->updated_at->format('d/m/Y') }}</span>
                    </div>
                    
                    @if($apropos->image_url)
                    <hr class="border-gray-200 dark:border-gray-700">
                    
                    <div>
                        <span class="text-sm text-gray-600 dark:text-gray-400 block mb-2">Image</span>
                        <img src="{{ str_starts_with($apropos->image_url, 'http') ? $apropos->image_url : asset($apropos->image_url) }}" 
                             alt="Image"
                             class="w-full rounded-lg border-2 border-gray-300 dark:border-gray-600"
                             onerror="this.style.display='none'">
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

