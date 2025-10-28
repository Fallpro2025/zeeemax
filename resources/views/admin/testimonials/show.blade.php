@extends('layouts.admin-sidebar')

@section('title', 'Témoignage: ' . $testimonial->nom_client . ' - ZEEEMAX Admin')
@section('page-title', 'Détails du Témoignage')
@section('page-description', 'Consultez le témoignage client')

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
                <a href="{{ route('admin.testimonials.index') }}" class="hover:text-blue-600 transition-colors">Témoignages</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-blue-600">{{ $testimonial->nom_client }}</span>
            </div>
            <div class="flex items-center space-x-3">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $testimonial->nom_client }}</h1>
                @if($testimonial->featured)
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 text-sm font-medium rounded-full">
                        ⭐ Featured
                    </span>
                @endif
                @if($testimonial->actif)
                    <span class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 text-sm font-medium rounded-full">
                        Actif
                    </span>
                @endif
            </div>
        </div>
        
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Modifier
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Contenu principal -->
        <div class="lg:col-span-2">
            
            <!-- Témoignage -->
            <div class="glass dark:glass-dark rounded-2xl p-8 animate-slide-up">
                <div class="flex items-start space-x-6">
                    @if($testimonial->avatar_url)
                        <div class="flex-shrink-0">
                            <img src="{{ $testimonial->avatar_url }}" 
                                 alt="{{ $testimonial->nom_client }}"
                                 class="w-16 h-16 rounded-full object-cover">
                        </div>
                    @else
                        <div class="flex-shrink-0 w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-blue-600">{{ substr($testimonial->nom_client, 0, 1) }}</span>
                        </div>
                    @endif
                    
                    <div class="flex-1">
                        <div class="flex items-center space-x-4 mb-4">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $testimonial->nom_client }}</h2>
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $testimonial->note)
                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-gray-300 dark:text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endif
                                @endfor
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">({{ $testimonial->note }}/5)</span>
                            </div>
                        </div>
                        
                        <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $testimonial->profession }}</p>
                        
                        <div class="relative">
                            <svg class="absolute top-0 left-0 w-8 h-8 text-blue-200 dark:text-blue-800 -mt-2 -ml-2" fill="currentColor" viewBox="0 0 32 32">
                                <path d="M10 8c-3.3 0-6 2.7-6 6v10c0 1.1.9 2 2 2h4c1.1 0 2-.9 2-2V14c0-1.1-.9-2-2-2H8c0-2.2 1.8-4 4-4V8zM22 8c-3.3 0-6 2.7-6 6v10c0 1.1.9 2 2 2h4c1.1 0 2-.9 2-2V14c0-1.1-.9-2-2-2h-2c0-2.2 1.8-4 4-4V8z"/>
                            </svg>
                            <blockquote class="text-lg text-gray-900 dark:text-white leading-relaxed italic pl-6">
                                {{ $testimonial->contenu }}
                            </blockquote>
                        </div>
                        
                        @if($testimonial->metrique)
                            <div class="mt-6 p-4 bg-green-50 dark:bg-green-900/20 rounded-xl">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    <span class="font-semibold text-green-800 dark:text-green-200">Résultat :</span>
                                </div>
                                <p class="text-green-700 dark:text-green-300 mt-1">{{ $testimonial->metrique }}</p>
                            </div>
                        @endif
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
                    <button onclick="toggleTestimonial({{ $testimonial->id }})" 
                            class="w-full flex items-center justify-center px-4 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        {{ $testimonial->featured ? 'Retirer des favoris' : 'Mettre en avant' }}
                    </button>
                    
                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce témoignage ?')"
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
                        <span class="text-sm font-medium text-gray-900 dark:text-white">#{{ $testimonial->id }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Note</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $testimonial->note }}/5 ⭐</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Statut</span>
                        <span class="text-sm font-medium {{ $testimonial->actif ? 'text-green-600' : 'text-red-600' }}">
                            {{ $testimonial->actif ? 'Actif' : 'Inactif' }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Featured</span>
                        <span class="text-sm font-medium {{ $testimonial->featured ? 'text-yellow-600' : 'text-gray-500' }}">
                            {{ $testimonial->featured ? 'Oui' : 'Non' }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Ordre</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $testimonial->ordre }}</span>
                    </div>
                    
                    <hr class="border-gray-200 dark:border-gray-700">
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Créé le</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $testimonial->created_at->format('d/m/Y') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Modifié le</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $testimonial->updated_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function toggleTestimonial(testimonialId) {
        window.adminUtils.request(`/admin/testimonials/${testimonialId}/toggle`, {
            method: 'POST'
        })
        .then(data => {
            if (data.status === 'success') {
                window.location.reload();
            } else {
                window.adminUtils.showToast('Erreur lors de la modification du témoignage', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            window.adminUtils.showToast('Erreur de communication', 'error');
        });
    }
</script>
@endpush

@endsection
