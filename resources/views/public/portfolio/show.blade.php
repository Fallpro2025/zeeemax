@extends('layouts.app')

@section('title', $item->titre . ' - Portfolio ZEEEMAX')
@section('description', substr($item->description, 0, 160))

@section('content')
<!-- Hero Section -->
<section class="relative py-32 bg-gradient-to-br from-purple-900 via-purple-800 to-blue-900 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        @if($item->image_url)
            <div class="absolute inset-0" style="background-image: url('{{ str_starts_with($item->image_url, 'http') ? $item->image_url : asset($item->image_url) }}'); background-size: cover; background-position: center;"></div>
        @endif
    </div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <span class="text-purple-300 font-bold uppercase tracking-widest text-sm mb-4 block">{{ $item->categorie }}</span>
        <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight">{{ $item->titre }}</h1>
    </div>
</section>

<!-- Project Details -->
<section class="py-24 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12">
            @if($item->image_url)
            <img src="{{ str_starts_with($item->image_url, 'http') ? $item->image_url : asset($item->image_url) }}" 
                 alt="{{ $item->titre }}" 
                 class="w-full rounded-3xl shadow-2xl mb-8">
            @endif
            
            <div class="prose prose-lg max-w-none mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">À propos du projet</h2>
                <p class="text-gray-700 leading-relaxed text-lg">{{ $item->description }}</p>
            </div>
            
            @if($item->technologies && count($item->technologies) > 0)
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Technologies utilisées</h3>
                <div class="flex flex-wrap gap-3">
                    @foreach($item->technologies as $tech)
                    <span class="px-4 py-2 bg-purple-100 text-purple-700 rounded-full font-semibold">{{ $tech }}</span>
                    @endforeach
                </div>
            </div>
            @endif
            
            <div class="flex gap-4 mt-8">
                @if($item->lien_demo)
                <a href="{{ $item->lien_demo }}" target="_blank" rel="noopener" class="inline-flex items-center bg-purple-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-purple-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    Voir la démo
                </a>
                @endif
                @if($item->lien_github)
                <a href="{{ $item->lien_github }}" target="_blank" rel="noopener" class="inline-flex items-center bg-gray-800 text-white px-6 py-3 rounded-xl font-semibold hover:bg-gray-900 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                    </svg>
                    Code source
                </a>
                @endif
            </div>
        </div>
        
        <div class="text-center mt-12 pt-12 border-t border-gray-200">
            <a href="{{ route('portfolio.index') }}" class="inline-flex items-center text-purple-600 font-bold hover:text-purple-700 transition-colors">
                ← Retour au portfolio
            </a>
        </div>
    </div>
</section>
@endsection

