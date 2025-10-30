@extends('layouts.app')

@section('title', $service->titre . ' - ZEEEMAX')
@section('description', substr($service->description, 0, 160))

@section('content')
<!-- Hero Section -->
<section class="relative py-32 bg-gradient-to-br from-purple-900 via-purple-800 to-blue-900 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute inset-0" style="background-image: url('{{ asset('images/hero-bg.jpg') }}'); background-size: cover; background-position: center;"></div>
    </div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <div class="w-24 h-24 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mx-auto mb-6">
            @if($service->icone_svg)
                {!! $service->getIcone() !!}
            @endif
        </div>
        <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight">{{ $service->titre }}</h1>
        <div class="prose prose-lg prose-invert max-w-3xl mx-auto">
            <p class="text-xl text-purple-100 leading-relaxed">{{ $service->description }}</p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-24 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-lg max-w-none">
            <div class="bg-gray-50 rounded-2xl p-8 mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Détails du service</h2>
                <div class="text-gray-700 leading-relaxed">
                    {{ $service->description }}
                </div>
            </div>
        </div>
        
        <div class="mt-12 text-center">
            <a href="{{ route('contact.index') }}" class="inline-block bg-purple-600 text-white px-10 py-4 rounded-full text-lg font-bold hover:bg-purple-700 transition-all duration-300 shadow-xl hover:shadow-2xl hover:scale-105 uppercase tracking-wide">
                Demander un devis
            </a>
        </div>
    </div>
</section>
@endsection

