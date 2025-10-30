@extends('layouts.app')

@section('title', 'Nos Services - ZEEEMAX')
@section('description', 'Découvrez nos services de branding, communication et stratégie digitale pour révéler votre identité de marque')

@section('content')
<!-- Hero Section -->
<section class="relative py-32 bg-gradient-to-br from-purple-900 via-purple-800 to-blue-900 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute inset-0" style="background-image: url('{{ asset('images/hero-bg.jpg') }}'); background-size: cover; background-position: center;"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <p class="text-purple-300 font-bold uppercase tracking-widest text-sm mb-4 animate-fade-in-up">Nos Services</p>
            <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight animate-fade-in-up animation-delay-200">
                Choisissez votre<br class="hidden sm:block"> point de départ
            </h1>
            <p class="text-xl md:text-2xl text-purple-100 max-w-3xl mx-auto leading-relaxed animate-fade-in-up animation-delay-400">
                Des solutions sur-mesure pour révéler votre identité et faire rayonner votre marque
            </p>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($services->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                <div class="group bg-white p-10 rounded-2xl border border-gray-200 hover:border-purple-200 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-purple-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        @if($service->icone_svg)
                            {!! $service->getIcone() !!}
                        @else
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                            </svg>
                        @endif
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 mb-4 tracking-tight">{{ $service->titre }}</h3>
                    <p class="text-gray-600 mb-8 leading-relaxed font-light">
                        {{ $service->description }}
                    </p>
                    <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center text-purple-600 font-bold hover:text-purple-700 transition-colors group">
                        En savoir plus
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-gray-600 text-lg">Aucun service disponible pour le moment.</p>
            </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-purple-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-5xl font-black mb-6">
            Prêt à révéler votre identité ?
        </h2>
        <p class="text-xl text-purple-100 mb-8 max-w-2xl mx-auto">
            Discutons de votre projet et découvrons ensemble comment ZEEEMAX peut vous accompagner
        </p>
        <a href="{{ route('contact.index') }}" class="inline-block bg-white text-purple-600 px-10 py-4 rounded-full text-lg font-bold hover:bg-gray-100 transition-all duration-300 shadow-xl hover:shadow-2xl hover:scale-105 uppercase tracking-wide">
            Prendre contact
        </a>
    </div>
</section>
@endsection

