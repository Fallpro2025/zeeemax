@extends('layouts.app')

@section('title', 'Contactez-nous - ZEEEMAX')
@section('description', 'Prenez contact avec ZEEEMAX pour discuter de votre projet et découvrir comment nous pouvons vous accompagner')

@section('content')
<!-- Hero Section -->
<section class="relative py-56 bg-gradient-to-br from-purple-900 via-purple-800 to-blue-900 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute inset-0" style="background-image: url('{{ asset('images/hero-bg.jpg') }}'); background-size: cover; background-position: center;"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-6 leading-tight title-gradient-glass" style="opacity: 0.95;">
                Lançons ensemble votre activité
            </h1>
            <p class="text-xl md:text-2xl text-purple-100 max-w-3xl mx-auto leading-relaxed animate-fade-in-up animation-delay-200">
                Nous serons à vos côtés à chaque étape pour révéler votre identité de marque
            </p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="relative py-20 bg-gray-900 text-white overflow-hidden">
    @include('partials.anime-background')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Formulaire de contact -->
            <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20">
                <h3 class="text-2xl font-bold mb-6 text-white title-gradient-glass-white">Prendre contact</h3>
                @if(session('success'))
                    <div class="mb-6 bg-green-500 text-white px-4 py-3 rounded-xl">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <input type="text" name="first_name" placeholder="Prénom *" required 
                                   value="{{ old('first_name') }}"
                                   class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:border-purple-400 transition-colors">
                            @error('first_name')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <input type="text" name="last_name" placeholder="Nom *" required 
                                   value="{{ old('last_name') }}"
                                   class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:border-purple-400 transition-colors">
                            @error('last_name')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <input type="email" name="email" placeholder="Email *" required 
                               value="{{ old('email') }}"
                               class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:border-purple-400 transition-colors">
                        @error('email')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input type="text" name="subject" placeholder="Objet *" required 
                               value="{{ old('subject') }}"
                               class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:border-purple-400 transition-colors">
                        @error('subject')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <textarea name="message" placeholder="Message *" rows="6" required 
                                  class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:border-purple-400 transition-colors resize-none">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full bg-purple-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-purple-700 transition-colors transform hover:scale-105 duration-300 shadow-lg">
                        Envoyer le message
                    </button>
                </form>
            </div>
            
            <!-- Informations de contact -->
            <div class="space-y-8">
                <div class="bg-gradient-to-br from-gray-800/90 to-gray-900/90 backdrop-blur-md p-6 rounded-2xl border border-gray-700/50">
                    <h3 class="text-2xl font-bold mb-6 text-white title-gradient-glass-white">Contactez-nous</h3>
                    <div class="space-y-4">
                        @if(!empty($settings?->email))
                        <div class="flex items-center space-x-4 group">
                            <div class="icon-3d-gradient w-12 h-12 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <div class="icon-svg-wrapper">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                </div>
                            </div>
                            <div>
                                <p class="font-semibold text-white">Email</p>
                                <a href="mailto:{{ $settings->email }}" class="text-pink-200 hover:text-pink-100 transition-colors">{{ $settings->email }}</a>
                            </div>
                        </div>
                        @endif
                        
                        @if(!empty($settings?->telephone))
                        <div class="flex items-center space-x-4 group">
                            <div class="icon-3d-gradient w-12 h-12 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <div class="icon-svg-wrapper">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                </div>
                            </div>
                            <div>
                                <p class="font-semibold text-white">Téléphone</p>
                                <a href="tel:{{ preg_replace('/\s+/', '', $settings->telephone) }}" class="text-blue-200 hover:text-blue-100 transition-colors">{{ $settings->telephone }}</a>
                            </div>
                        </div>
                        @endif
                        
                        @php($adresseComplete = collect([$settings?->adresse, $settings?->code_postal, $settings?->ville, $settings?->pays])->filter()->implode(', '))
                        @if(!empty($adresseComplete))
                        <div class="flex items-center space-x-4 group">
                            <div class="icon-3d-gradient w-12 h-12 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <div class="icon-svg-wrapper">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                </div>
                            </div>
                            <div>
                                <p class="font-semibold text-white">Localisation</p>
                                <p class="text-green-200">{{ $adresseComplete }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-purple-500/20 to-blue-500/20 backdrop-blur-md p-8 rounded-2xl border-2 border-purple-400/30 shadow-lg">
                    <h4 class="font-bold text-xl mb-4 text-white">Prendre RDV gratuit</h4>
                    <p class="text-purple-100 mb-6 leading-relaxed">
                        Réservez un appel découverte de 30 minutes pour échanger sur votre projet et découvrir comment ZEEEMAX peut vous aider.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
@include('partials.anime-scripts')
@endpush
@endsection

