@extends('layouts.app')

@section('title', 'Portfolio - ZEEEMAX')
@section('description', 'Découvrez nos réalisations et projets à succès en branding, communication et stratégie digitale')

@section('content')
<!-- Hero Section -->
<section class="relative py-56 bg-gradient-to-br from-purple-900 via-purple-800 to-blue-900 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute inset-0" style="background-image: url('{{ asset('images/hero-bg.jpg') }}'); background-size: cover; background-position: center;"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <p class="text-purple-300 font-bold uppercase tracking-widest text-sm mb-4 animate-fade-in-up">Portfolio</p>
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-6 leading-tight title-gradient-glass" style="opacity: 0.95;">
                Découvrez nos projets à succès
            </h1>
            <p class="text-xl md:text-2xl text-purple-100 max-w-3xl mx-auto leading-relaxed animate-fade-in-up animation-delay-400">
                Un aperçu de notre travail avec des entrepreneurs passionnés
            </p>
        </div>
    </div>
</section>

<!-- Filter & Portfolio Grid -->
<section class="relative py-24 bg-white overflow-hidden">
    @include('partials.anime-background')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        @if($categories->count() > 0)
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button onclick="filterPortfolio('all')" class="filter-btn active px-6 py-2 rounded-full bg-purple-600 text-white font-semibold hover:bg-purple-700 transition-colors" data-filter="all">
                Tous
            </button>
            @foreach($categories as $categorie)
            <button onclick="filterPortfolio('{{ $categorie }}')" class="filter-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition-colors" data-filter="{{ $categorie }}">
                {{ $categorie }}
            </button>
            @endforeach
        </div>
        @endif

        @if($portfolioItems->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10" id="portfolioGrid">
                @foreach($portfolioItems as $item)
                <div class="portfolio-item group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="{{ $item->categorie }}">
                    <div class="relative overflow-hidden">
                        <img src="{{ $item->image_url ? (str_starts_with($item->image_url, 'http') ? $item->image_url : asset($item->image_url)) : 'https://via.placeholder.com/600x400?text=' . urlencode($item->titre) }}" 
                             alt="{{ $item->titre }}" 
                             class="w-full h-64 object-cover object-center transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-purple-600 opacity-0 group-hover:opacity-90 transition-opacity duration-300 flex items-center justify-center">
                            <a href="{{ route('portfolio.show', $item->slug) }}" class="text-white font-bold text-lg">Voir le projet →</a>
                        </div>
                    </div>
                    <div class="p-8">
                        <span class="text-purple-600 text-sm font-bold uppercase tracking-wider mb-2 block">{{ $item->categorie }}</span>
                        <h3 class="text-2xl font-black mb-4 tracking-tight title-gradient-glass-sm">{{ $item->titre }}</h3>
                        <p class="text-gray-700 leading-relaxed font-light mb-6">{{ substr($item->description, 0, 120) }}{{ strlen($item->description) > 120 ? '...' : '' }}</p>
                        <a href="{{ route('portfolio.show', $item->slug) }}" class="inline-flex items-center text-purple-600 font-bold hover:text-purple-700 transition-colors group">
                            Voir le projet
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-gray-600 text-lg">Aucun projet portfolio disponible pour le moment.</p>
            </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-purple-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-5xl font-black mb-6 tracking-tight title-gradient-glass">
            Votre projet sera le prochain ?
        </h2>
        <p class="text-xl text-purple-100 mb-8 max-w-2xl mx-auto">
            Discutons de votre projet et créons ensemble quelque chose d'extraordinaire
        </p>
        <a href="{{ route('contact.index') }}" class="inline-block bg-white text-purple-600 px-10 py-4 rounded-full text-lg font-bold hover:bg-gray-100 transition-all duration-300 shadow-xl hover:shadow-2xl hover:scale-105 uppercase tracking-wide">
            Démarrer un projet
        </a>
    </div>
</section>
@endsection

@push('scripts')
@include('partials.anime-scripts')
<script>
    function filterPortfolio(category) {
        const items = document.querySelectorAll('.portfolio-item');
        const buttons = document.querySelectorAll('.filter-btn');
        
        // Mettre à jour les boutons actifs
        buttons.forEach(btn => {
            btn.classList.remove('active', 'bg-purple-600', 'text-white');
            btn.classList.add('bg-gray-200', 'text-gray-700');
        });
        
        event.target.classList.add('active', 'bg-purple-600', 'text-white');
        event.target.classList.remove('bg-gray-200', 'text-gray-700');
        
        // Filtrer les items
        items.forEach(item => {
            if (category === 'all' || item.dataset.category === category) {
                item.style.display = 'block';
                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, 10);
            } else {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    item.style.display = 'none';
                }, 300);
            }
        });
    }
</script>
@endpush

