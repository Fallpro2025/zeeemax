@extends('layouts.app')

@section('title', 'À propos - ZEEEMAX')
@section('description', 'Découvrez ZEEEMAX : notre histoire, notre mission et notre équipe passionnée')

@section('content')
<!-- Hero Section -->
<section class="relative py-32 bg-gradient-to-br from-purple-900 via-purple-800 to-blue-900 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute inset-0" style="background-image: url('{{ asset('images/hero-bg.jpg') }}'); background-size: cover; background-position: center;"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight">
                <span class="text-purple-300">ZEEEMAX</span>: Révélez votre identité,<br class="hidden sm:block">faîtes rayonner votre projet.
            </h1>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="py-20 bg-white min-h-[600px] flex items-center">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                @if($apropos && $apropos->image_url)
                    <img src="{{ str_starts_with($apropos->image_url, 'http') ? $apropos->image_url : asset($apropos->image_url) }}" 
                         alt="ZEEEMAX" 
                         class="w-full rounded-3xl shadow-2xl">
                @else
                    <img src="{{ asset('images/md.jpg') }}" alt="ZEEEMAX" class="w-full rounded-3xl shadow-2xl">
                @endif
            </div>
            <div>
                @if($apropos && $apropos->titre)
                    <h2 class="text-4xl font-black text-gray-900 mb-6">{{ $apropos->titre }}</h2>
                @else
                    <h2 class="text-4xl font-black text-gray-900 mb-6">Notre histoire</h2>
                @endif
                <div class="space-y-6 text-gray-600 leading-relaxed text-lg">
                    @if($apropos && $apropos->description)
                        <div class="prose prose-lg max-w-none">
                            {!! nl2br(e($apropos->description)) !!}
                        </div>
                    @else
                        <p class="font-light">
                            <strong class="font-semibold text-gray-900">ZEEEMAX est né d'une envie profonde :</strong> aider les entrepreneur(e)s à révéler leur identité, construire une image de marque forte et faire rayonner leur projet avec impact.
                        </p>
                        <p class="font-light">
                            Forte d'une expérience de terrain et diplômée en <strong class="font-semibold text-gray-900">stratégie marketing & communication</strong>, j'accompagne les marques à clarifier leur positionnement et gagner en visibilité.
                        </p>
                    @endif
                    <div class="pt-4">
                        <a href="{{ route('contact.index') }}" class="inline-block bg-purple-600 text-white px-8 py-3 rounded-full text-base font-bold hover:bg-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 uppercase tracking-wide">
                            Prendre RDV
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistiques Section -->
<section class="py-24 bg-gradient-to-br from-purple-600 via-purple-700 to-blue-700 text-white relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 20% 50%, rgba(255,255,255,0.3) 0%, transparent 50%), radial-gradient(circle at 80% 80%, rgba(255,255,255,0.3) 0%, transparent 50%);"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-black mb-6">Nos réalisations en chiffres</h2>
            <p class="text-xl text-purple-100 max-w-2xl mx-auto font-light">
                Des résultats qui parlent d'eux-mêmes
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Statistique 1 -->
            <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 text-center border border-white/20 hover:bg-white/15 transition-all duration-300 transform hover:scale-105 hover:-translate-y-2">
                <div class="w-20 h-20 bg-white/20 rounded-full mx-auto mb-6 flex items-center justify-center">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                    </svg>
                </div>
                <div class="text-5xl font-black mb-3" data-count="{{ \App\Models\PortfolioItem::where('actif', true)->count() }}">0</div>
                <p class="text-purple-100 text-lg font-semibold uppercase tracking-wide">Projets réalisés</p>
            </div>
            
            <!-- Statistique 2 -->
            <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 text-center border border-white/20 hover:bg-white/15 transition-all duration-300 transform hover:scale-105 hover:-translate-y-2">
                <div class="w-20 h-20 bg-white/20 rounded-full mx-auto mb-6 flex items-center justify-center">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div class="text-5xl font-black mb-3" data-count="{{ \App\Models\Testimonial::where('actif', true)->count() }}">0</div>
                <p class="text-purple-100 text-lg font-semibold uppercase tracking-wide">Clients satisfaits</p>
            </div>
            
            <!-- Statistique 3 -->
            <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 text-center border border-white/20 hover:bg-white/15 transition-all duration-300 transform hover:scale-105 hover:-translate-y-2">
                <div class="w-20 h-20 bg-white/20 rounded-full mx-auto mb-6 flex items-center justify-center">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-5xl font-black mb-3" data-count="{{ \App\Models\Service::where('actif', true)->count() }}">0</div>
                <p class="text-purple-100 text-lg font-semibold uppercase tracking-wide">Services offerts</p>
            </div>
            
            <!-- Statistique 4 -->
            <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 text-center border border-white/20 hover:bg-white/15 transition-all duration-300 transform hover:scale-105 hover:-translate-y-2">
                <div class="w-20 h-20 bg-white/20 rounded-full mx-auto mb-6 flex items-center justify-center">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-5xl font-black mb-3" data-count="5">0</div>
                <p class="text-purple-100 text-lg font-semibold uppercase tracking-wide">Années d'expérience</p>
            </div>
        </div>
    </div>
</section>

<!-- Valeurs Section -->
@if(isset($valeurs) && $valeurs->count() > 0)
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">Nos valeurs</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto font-light">
                Les principes qui guident chaque action que nous entreprenons
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($valeurs as $valeur)
            <div class="bg-gradient-to-br from-purple-50 to-blue-50 p-8 rounded-2xl border-2 border-purple-100 hover:border-purple-300 transition-all duration-300 transform hover:scale-105 hover:-translate-y-2">
                <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6
                    @if($valeur->couleur === 'purple') bg-gradient-to-br from-purple-600 to-purple-700
                    @elseif($valeur->couleur === 'blue') bg-gradient-to-br from-blue-600 to-blue-700
                    @else bg-gradient-to-br from-purple-600 to-blue-600
                    @endif">
                    @if($valeur->icon === 'lightning')
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    @elseif($valeur->icon === 'shield')
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    @elseif($valeur->icon === 'heart')
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    @elseif($valeur->icon === 'star')
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                    @elseif($valeur->icon === 'rocket')
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    @elseif($valeur->icon === 'target')
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    @elseif($valeur->icon === 'users')
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    @elseif($valeur->icon === 'globe')
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    @elseif($valeur->icon === 'bulb')
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                    @elseif($valeur->icon === 'trophy')
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                    @elseif($valeur->icon === 'handshake')
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    @elseif($valeur->icon === 'check-circle')
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    @else
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    @endif
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $valeur->titre }}</h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ $valeur->description }}
                </p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Team Section -->
@if($team && $team->count() > 0)
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">Notre équipe</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto font-light">
                Rencontrez les talents qui font ZEEEMAX
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($team as $member)
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 text-center min-h-[420px] flex flex-col max-w-sm mx-auto group">
                <div class="w-48 h-48 rounded-xl mx-auto mb-6 overflow-hidden border-2 border-purple-100 shadow-md">
                    <img src="{{ $member->photo_url ? (str_starts_with($member->photo_url, 'http') ? $member->photo_url : asset($member->photo_url)) : 'https://ui-avatars.com/api/?name=' . urlencode($member->nom) . '&background=purple&color=fff&size=256' }}" 
                         alt="{{ $member->nom }}" 
                         class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-125">
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $member->nom }}</h3>
                <p class="text-purple-600 font-semibold mb-4">{{ $member->poste }}</p>
                @if($member->bio)
                    <p class="text-gray-600 leading-relaxed flex-grow">{{ $member->bio }}</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@push('scripts')
<script>
    // Animation des statistiques au scroll
    document.addEventListener('DOMContentLoaded', function() {
        const statsElements = document.querySelectorAll('[data-count]');
        
        const animateCount = (element) => {
            const target = parseInt(element.getAttribute('data-count'));
            const duration = 2000; // 2 secondes
            const steps = 60;
            const increment = target / steps;
            let current = 0;
            let step = 0;
            
            const timer = setInterval(() => {
                step++;
                current = Math.min(increment * step, target);
                element.textContent = Math.floor(current);
                
                if (step >= steps) {
                    clearInterval(timer);
                    element.textContent = target;
                }
            }, duration / steps);
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                    entry.target.classList.add('animated');
                    animateCount(entry.target);
                }
            });
        }, {
            threshold: 0.5
        });
        
        statsElements.forEach(stat => observer.observe(stat));
    });
</script>
@endpush
@endsection

