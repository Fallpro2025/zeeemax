@extends('layouts.app')

@section('title', 'Contactez-nous - ZEEEMAX')
@section('description', 'Prenez contact avec ZEEEMAX pour discuter de votre projet et découvrir comment nous pouvons vous accompagner')

@section('content')
<!-- Hero Section -->
<section class="relative py-32 bg-gradient-to-br from-purple-900 via-purple-800 to-blue-900 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute inset-0" style="background-image: url('{{ asset('images/hero-bg.jpg') }}'); background-size: cover; background-position: center;"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight animate-fade-in-up">
                Lançons ensemble<br class="hidden sm:block"> votre activité
            </h1>
            <p class="text-xl md:text-2xl text-purple-100 max-w-3xl mx-auto leading-relaxed animate-fade-in-up animation-delay-200">
                Nous serons à vos côtés à chaque étape pour révéler votre identité de marque
            </p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-20 bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Formulaire de contact -->
            <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20">
                <h3 class="text-2xl font-bold mb-6">Prendre contact</h3>
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
                <div>
                    <h3 class="text-2xl font-bold mb-6">Contactez-nous</h3>
                    <div class="space-y-4">
                        @if(!empty($settings?->email))
                        <div class="flex items-center space-x-4 group">
                            <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Email</p>
                                <a href="mailto:{{ $settings->email }}" class="text-gray-300 hover:text-purple-300 transition-colors">{{ $settings->email }}</a>
                            </div>
                        </div>
                        @endif
                        
                        @if(!empty($settings?->telephone))
                        <div class="flex items-center space-x-4 group">
                            <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Téléphone</p>
                                <a href="tel:{{ preg_replace('/\s+/', '', $settings->telephone) }}" class="text-gray-300 hover:text-purple-300 transition-colors">{{ $settings->telephone }}</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

