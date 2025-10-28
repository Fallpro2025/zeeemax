@extends('layouts.admin-sidebar')

@section('title', 'Message de ' . $contact->nomComplet . ' - ZEEEMAX Admin')
@section('page-title', 'Message de Contact')
@section('page-description', 'Détails du message et gestion')

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
                <a href="{{ route('admin.contacts.index') }}" class="hover:text-blue-600 transition-colors">Messages</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-blue-600">{{ $contact->nomComplet }}</span>
            </div>
            <div class="flex items-center space-x-3">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $contact->sujet }}</h1>
                @if($contact->statut === 'nouveau')
                    <span class="px-3 py-1 bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 text-sm font-medium rounded-full animate-pulse">
                        Nouveau
                    </span>
                @elseif($contact->statut === 'lu')
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 text-sm font-medium rounded-full">
                        Lu
                    </span>
                @elseif($contact->statut === 'archive')
                    <span class="px-3 py-1 bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200 text-sm font-medium rounded-full">
                        Archivé
                    </span>
                @endif
            </div>
        </div>
        
        <div class="flex items-center space-x-3">
            @if($contact->statut !== 'lu')
                <form action="{{ route('admin.contacts.mark-read', $contact) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Marquer lu
                    </button>
                </form>
            @endif
            
            @if($contact->statut !== 'archive')
                <form action="{{ route('admin.contacts.archive', $contact) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8l6 6 6-6"></path>
                        </svg>
                        Archiver
                    </button>
                </form>
            @endif
            
            <a href="{{ route('admin.contacts.index') }}" class="flex items-center px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Message principal -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Informations expéditeur -->
            <div class="glass dark:glass-dark rounded-2xl p-8 animate-slide-up">
                <div class="flex items-start space-x-6">
                    <div class="flex-shrink-0 w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                        <span class="text-2xl font-bold text-blue-600">{{ substr($contact->prenom, 0, 1) }}{{ substr($contact->nom, 0, 1) }}</span>
                    </div>
                    
                    <div class="flex-1">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $contact->nomComplet }}</h2>
                        
                        <div class="space-y-2">
                            <div class="flex items-center text-gray-600 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <a href="mailto:{{ $contact->email }}" class="hover:text-blue-600 transition-colors">{{ $contact->email }}</a>
                            </div>
                            
                            <div class="flex items-center text-gray-600 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Reçu le {{ $contact->created_at->format('d/m/Y à H:i') }}
                                <span class="ml-2 text-xs bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
                                    {{ $contact->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Message -->
            <div class="glass dark:glass-dark rounded-2xl p-8 animate-slide-up" style="animation-delay: 0.1s;">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ $contact->sujet }}</h3>
                
                <div class="prose dark:prose-invert max-w-none">
                    <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-6 border-l-4 border-blue-500">
                        <p class="text-gray-900 dark:text-white leading-relaxed whitespace-pre-wrap">{{ $contact->message }}</p>
                    </div>
                </div>
            </div>

            <!-- Notes administratives -->
            <div class="glass dark:glass-dark rounded-2xl p-8 animate-slide-up" style="animation-delay: 0.2s;">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Notes administratives</h3>
                
                <form action="{{ route('admin.contacts.notes', $contact) }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label for="notes_admin" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Notes internes (privées)
                        </label>
                        <textarea id="notes_admin" 
                                  name="notes_admin" 
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                  placeholder="Ajoutez vos notes sur ce contact, les actions prises, le suivi nécessaire...">{{ $contact->notes_admin }}</textarea>
                        @error('notes_admin')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex items-center justify-end">
                        <button type="submit" 
                                class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors">
                            Enregistrer les notes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            
            <!-- Actions rapides -->
            <div class="glass dark:glass-dark rounded-2xl p-6 animate-slide-up" style="animation-delay: 0.1s;">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Actions</h3>
                
                <div class="space-y-3">
                    <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->sujet }}" 
                       class="w-full flex items-center justify-center px-4 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Répondre par email
                    </a>
                    
                    @if($contact->statut !== 'lu')
                        <form action="{{ route('admin.contacts.mark-read', $contact) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" 
                                    class="w-full flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Marquer comme lu
                            </button>
                        </form>
                    @endif
                    
                    @if($contact->statut !== 'archive')
                        <form action="{{ route('admin.contacts.archive', $contact) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" 
                                    class="w-full flex items-center justify-center px-4 py-3 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8l6 6 6-6"></path>
                                </svg>
                                Archiver
                            </button>
                        </form>
                    @endif
                    
                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?')"
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
                        <span class="text-sm font-medium text-gray-900 dark:text-white">#{{ $contact->id }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Statut</span>
                        <span class="text-sm font-medium {{ $contact->statut === 'nouveau' ? 'text-red-600' : ($contact->statut === 'lu' ? 'text-blue-600' : 'text-gray-600') }}">
                            {{ ucfirst($contact->statut) }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Prénom</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $contact->prenom }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Nom</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $contact->nom }}</span>
                    </div>
                    
                    <hr class="border-gray-200 dark:border-gray-700">
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Reçu le</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $contact->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    
                    @if($contact->lu_le)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Lu le</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $contact->lu_le->format('d/m/Y H:i') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Navigation entre messages -->
            <div class="glass dark:glass-dark rounded-2xl p-6 animate-slide-up" style="animation-delay: 0.3s;">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Navigation</h3>
                
                <div class="space-y-3">
                    @php
                        $previousContact = \App\Models\ContactMessage::where('id', '<', $contact->id)->orderBy('id', 'desc')->first();
                        $nextContact = \App\Models\ContactMessage::where('id', '>', $contact->id)->orderBy('id', 'asc')->first();
                    @endphp
                    
                    @if($previousContact)
                        <a href="{{ route('admin.contacts.show', $previousContact) }}" 
                           class="flex items-center p-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            <span class="text-sm">{{ Str::limit($previousContact->sujet, 25) }}</span>
                        </a>
                    @endif
                    
                    @if($nextContact)
                        <a href="{{ route('admin.contacts.show', $nextContact) }}" 
                           class="flex items-center justify-between p-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                            <span class="text-sm">{{ Str::limit($nextContact->sujet, 25) }}</span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @endif
                    
                    @if(!$previousContact && !$nextContact)
                        <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">
                            Aucun autre message
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

