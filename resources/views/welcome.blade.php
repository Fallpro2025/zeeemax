@extends('layouts.app')

@section('title', 'ZEEEMAX - Révélez votre identité de marque')
@section('description', 'ZEEEMAX accompagne les entrepreneurs à construire une image forte et impactante grâce à un branding sur-mesure et une stratégie digitale alignée.')

@section('content')
<!-- Hero Section - Style Dream Biz avec image de fond et textes courts -->
<section id="accueil" class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Background dynamique (image ou vidéo) avec overlay -->
    <div class="absolute inset-0">
        @if(isset($homepage) && $homepage && $homepage->background_type === 'video' && $homepage->background_video_url)
            @php
                $videoUrl = $homepage->background_video_url;
                $embedUrl = null;
                if (str_contains($videoUrl, 'youtu.be/')) {
                    $after = explode('youtu.be/', $videoUrl)[1] ?? '';
                    $id = strtok($after, '?');
                    if ($id) {
                        $embedUrl = 'https://www.youtube.com/embed/'.$id.'?autoplay=1&mute=1&loop=1&playlist='.$id.'&controls=0&showinfo=0&modestbranding=1&iv_load_policy=3&rel=0';
                    }
                } elseif (str_contains($videoUrl, 'youtube.com/watch')) {
                    if (preg_match('/[?&]v=([^&]+)/', $videoUrl, $m)) {
                        $id = $m[1];
                        $embedUrl = 'https://www.youtube.com/embed/'.$id.'?autoplay=1&mute=1&loop=1&playlist='.$id.'&controls=0&showinfo=0&modestbranding=1&iv_load_policy=3&rel=0';
                    }
                } elseif (str_contains($videoUrl, 'vimeo.com/')) {
                    $parts = explode('/', trim($videoUrl, '/'));
                    $id = end($parts);
                    if ($id && is_numeric($id)) {
                        $embedUrl = 'https://player.vimeo.com/video/'.$id.'?background=1&autoplay=1&muted=1&loop=1';
                    }
                }
            @endphp
            @if($embedUrl)
                <iframe src="{{ $embedUrl }}" title="Background video" class="w-full h-full" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
            @else
                <video autoplay muted loop playsinline class="w-full h-full object-cover object-center">
                    <source src="{{ str_starts_with($videoUrl, 'http') ? $videoUrl : asset($videoUrl) }}">
                </video>
            @endif
        @elseif(isset($homepage) && $homepage && $homepage->background_type === 'image' && $homepage->background_image_url)
            <!-- Image de fond dynamique -->
            <img src="{{ str_starts_with($homepage->background_image_url, 'http') ? $homepage->background_image_url : asset($homepage->background_image_url) }}" 
                 alt="Background" 
                 class="w-full h-full object-cover object-center"
                 onerror="this.src='{{ asset('images/hero-bg.jpg') }}'"/>
        @else
            <!-- Image par défaut -->
            <img src="{{ asset('images/hero-bg.jpg') }}" 
                 alt="Femme entrepreneure travaillant" 
                 class="w-full h-full object-cover object-center"/>
        @endif
        <div class="absolute inset-0 bg-black opacity-60"></div> <!-- Overlay sombre légèrement plus opaque -->
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-white text-center py-20">
        <!-- Titre principal dynamique -->
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold mb-6 leading-tight opacity-0 animate-fade-in-up">
            {!! isset($homepage) && $homepage && $homepage->titre ? nl2br(e($homepage->titre)) : 'Révélez votre <br class="hidden sm:block">identité de marque' !!}
        </h1>
        
        <!-- Sous-titre dynamique -->
        <p class="text-xl md:text-2xl mb-12 max-w-4xl mx-auto leading-relaxed opacity-0 animate-fade-in-up animation-delay-200 font-light">
            {!! isset($homepage) && $homepage && $homepage->description ? nl2br(e($homepage->description)) : 'Accompagner les entrepreneurs à construire une image forte et impactante.' !!}
        </p>
        
        <!-- CTA dynamique -->
        @if(isset($homepage) && $homepage && $homepage->bouton_texte && $homepage->bouton_url)
        <div class="opacity-0 animate-fade-in-up animation-delay-400">
            <a href="{{ str_starts_with($homepage->bouton_url, '#') || str_starts_with($homepage->bouton_url, '/') ? url($homepage->bouton_url) : $homepage->bouton_url }}" 
               class="inline-block bg-purple-600 text-white px-10 py-4 rounded-full text-lg font-bold hover:bg-purple-700 transition-all duration-300 shadow-xl hover:shadow-2xl hover:scale-105 uppercase tracking-wide">
                {{ $homepage->bouton_texte }}
            </a>
        </div>
        @else
        <div class="opacity-0 animate-fade-in-up animation-delay-400">
            <a href="#services" class="inline-block bg-purple-600 text-white px-10 py-4 rounded-full text-lg font-bold hover:bg-purple-700 transition-all duration-300 shadow-xl hover:shadow-2xl hover:scale-105 uppercase tracking-wide">
                Découvrir mes services
            </a>
        </div>
        @endif
    </div>
</section>

<!-- À propos Section -->
<section id="apropos" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center lg:py-20">
            <!-- Content -->
            <div class="lg:pr-12">
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-6 tracking-tight">
                    <span class="text-purple-600">ZEEEMAX</span>: Révélez votre identité,<br class="hidden sm:block">faîtes rayonner votre projet.
                </h2>
                <div class="space-y-6 text-gray-600 leading-relaxed text-lg">
                    <p class="font-light">
                        <strong class="font-semibold text-gray-900">ZEEEMAX est né d’une envie profonde :</strong> aider les entrepreneur(e)s à révéler leur identité, construire une image de marque forte et faire rayonner leur projet avec impact.
                    </p>
                    <p class="font-light">
                        Forte d'une expérience de terrain et diplômée en <strong class="font-semibold text-gray-900">stratégie marketing & communication</strong>, j'accompagne les marques à clarifier leur positionnement et gagner en visibilité.
                    </p>
                    <div class="pt-4">
                        <a href="#contact" class="inline-block bg-purple-600 text-white px-8 py-3 rounded-full text-base font-bold hover:bg-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 uppercase tracking-wide">
                            Prendre RDV
                        </a>
                    </div>
                </div>
            </div>
            <!-- Visual de la section (image de femme) -->
            <div class="relative flex justify-center items-center h-full min-h-[300px] lg:min-h-[500px]">
                <div class="w-full h-full rounded-3xl overflow-hidden image-about-shadow">
                    <img src="{{ asset('images/md.jpg') }}" 
                         alt="Femme inspirante ZEEEMAX" 
                         class="w-full h-full object-cover object-center"
                         loading="eager"
                         fetchpriority="high"
                         decoding="async"
                         width="600" 
                         height="500"/>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section - Style Dream Biz épuré -->
<section id="services" class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <p class="text-purple-600 font-bold uppercase tracking-widest text-sm mb-4">Découvrez nos services</p>
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6 tracking-tight">
                Choisissez votre point de départ
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto font-light">
                Des solutions sur-mesure pour révéler votre identité et faire rayonner votre marque
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="group bg-white p-10 rounded-2xl border border-gray-200 hover:border-purple-200 hover:shadow-2xl transition-all duration-300">
                <div class="w-16 h-16 bg-purple-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    {!! $service->icon !!}
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-4 tracking-tight">{{ $service->title }}</h3>
                <p class="text-gray-600 mb-8 leading-relaxed font-light">
                    {{ $service->description }}
                </p>
                <a href="#contact" class="inline-flex items-center text-purple-600 font-bold hover:text-purple-700 transition-colors group">
                    Commencer
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section id="portfolio" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <p class="text-purple-600 font-bold uppercase tracking-widest text-sm mb-4">Mes réalisations</p>
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6 tracking-tight">
                Découvrez nos projets à succès
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto font-light">
                Un aperçu de mon travail avec des entrepreneurs passionnés.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($portfolioItems as $item)
            <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <img src="{{ str_starts_with($item->image_url, 'http') ? $item->image_url : asset($item->image_url) }}" alt="{{ $item->titre }}" class="w-full h-64 object-cover object-center transition-transform duration-300 group-hover:scale-105">
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $item->titre }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ $item->categorie }}</p>
                    <p class="text-gray-700 leading-relaxed font-light mb-6">{{ $item->description }}</p>
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
        <div class="text-center mt-12">
            <a href="{{ route('portfolio.index') }}" class="inline-block bg-gray-900 text-white px-8 py-3 rounded-full font-semibold hover:bg-gray-800 transition-colors">Voir tous les projets</a>
        </div>
    </div>
</section>

<!-- Témoignages Section - Style Dream Biz -->
<section id="temoignages" class="relative py-24 text-white overflow-hidden">
    <!-- Image de fond avec effet parallaxe et overlay sombre -->
    <div class="absolute inset-0 bg-cover bg-center bg-fixed" style="background-image: url('{{ asset('images/testimonials-bg.jpg') }}');">
        <div class="absolute inset-0 bg-black opacity-60"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-20">
            <h2 class="text-4xl md:text-5xl font-black mb-6 tracking-tight">
                Ils sont satisfaits de nos services !
            </h2>
            <p class="text-xl font-light">
                Découvrez ce que nos clients disent de notre expertise
            </p>
        </div>
        
        <div x-data="{
             currentIndex: 0,
             testimonials: {{ $testimonials->toJson() }},
             interval: null,
             init() {
                 this.start();
             },
             start() {
                 this.interval = setInterval(() => {
                     this.currentIndex = (this.currentIndex + 1) % this.testimonials.length;
                 }, 5000);
             },
             pause() {
                 if (this.interval) clearInterval(this.interval);
             },
             goTo(index) {
                 this.currentIndex = index;
             }
         }" 
             @mouseover="pause()" 
             @mouseout="start()"
             class="relative mx-auto max-w-4xl">
            <!-- Testimonial cards -->
            <div class="relative h-64 overflow-hidden rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 shadow-lg">
                <template x-for="(testimonial, index) in testimonials" :key="index">
                    <div x-show="currentIndex === index" 
                         x-transition:enter="transition ease-out duration-1000" 
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-500" 
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="absolute inset-0 p-8 flex items-center justify-center text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 font-bold text-3xl mb-4"
                                 x-text="testimonial.name.substring(0, 1)">
                            </div>
                            <h4 class="font-semibold text-xl" x-text="testimonial.name"></h4>
                            <p class="text-gray-200 text-sm mb-6" x-text="testimonial.profession"></p>
                            <p class="mb-4 italic leading-relaxed text-gray-100 text-lg" x-text="testimonial.content"></p>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Navigation dots -->
            <div class="flex justify-center space-x-2 mt-8">
                <template x-for="(testimonial, index) in testimonials" :key="index">
                    <button @click="goTo(index)" 
                            :class="{'bg-purple-600': currentIndex === index, 'bg-gray-400': currentIndex !== index}"
                            class="w-3 h-3 rounded-full transition-colors duration-300"></button>
                </template>
            </div>
        </div>
    </div>
</section>

<!-- Partenaires Section - Slider Ultra Moderne -->
<section class="py-24 bg-gradient-to-br from-gray-50 to-purple-50 overflow-visible relative" style="z-index: 30;">
    <!-- Background décoration -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 20% 50%, rgba(147, 51, 234, 0.3) 0%, transparent 50%), radial-gradient(circle at 80% 80%, rgba(59, 130, 246, 0.3) 0%, transparent 50%);"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <p class="text-purple-600 font-bold uppercase tracking-widest text-sm mb-4">Nos Partenaires</p>
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6 tracking-tight">
                Ils nous font confiance
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto font-light">
                Des entreprises qui nous font confiance pour leur identité de marque
            </p>
        </div>
        
        @if(isset($partners) && $partners->count() > 0)
        <!-- Slider Ultra Moderne -->
        <div class="relative" style="z-index: 40;">
            <!-- Masque gradient pour effet fade -->
            <div class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-gray-50 via-gray-50 to-transparent z-20 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-gray-50 via-gray-50 to-transparent z-20 pointer-events-none"></div>
            
            <!-- Flèches de navigation -->
            <button onclick="scrollPartners(-1)" class="absolute left-4 top-1/2 -translate-y-1/2 z-50 w-12 h-12 bg-white rounded-full shadow-xl hover:shadow-2xl flex items-center justify-center transition-all duration-300 hover:scale-110 hover:bg-purple-600 group">
                <svg class="w-6 h-6 text-gray-700 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button onclick="scrollPartners(1)" class="absolute right-4 top-1/2 -translate-y-1/2 z-50 w-12 h-12 bg-white rounded-full shadow-xl hover:shadow-2xl flex items-center justify-center transition-all duration-300 hover:scale-110 hover:bg-purple-600 group">
                <svg class="w-6 h-6 text-gray-700 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            
            <!-- Container du slider -->
            <div class="overflow-visible" style="padding-top: 2rem; padding-bottom: 2rem;">
                <div id="partners-slider" class="partners-slider relative z-40 flex space-x-12 animate-scroll" style="will-change: transform;">
                    <!-- Première série de logos -->
                    @foreach($partners as $partner)
                    <div class="partner-item flex-shrink-0 group relative z-40">
                        <div class="w-48 h-32 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 flex items-center justify-center p-6 border border-gray-200 hover:border-purple-400 transform hover:scale-110 hover:-translate-y-2 relative z-40">
                            @if($partner->site_web)
                            <a href="{{ $partner->site_web }}" target="_blank" rel="noopener" class="w-full h-full flex items-center justify-center">
                                <img src="{{ $partner->logo_url ? (str_starts_with($partner->logo_url, 'http') ? $partner->logo_url : asset($partner->logo_url)) : 'https://ui-avatars.com/api/?name=' . urlencode($partner->nom) . '&background=purple&color=fff&size=128' }}" 
                                     alt="{{ $partner->nom }}" 
                                     class="max-w-full max-h-full object-contain transition-all duration-500 opacity-100"
                                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($partner->nom) }}&background=purple&color=fff&size=128'">
                            </a>
                            @else
                            <img src="{{ $partner->logo_url ? (str_starts_with($partner->logo_url, 'http') ? $partner->logo_url : asset($partner->logo_url)) : 'https://ui-avatars.com/api/?name=' . urlencode($partner->nom) . '&background=purple&color=fff&size=128' }}" 
                                 alt="{{ $partner->nom }}" 
                                 class="max-w-full max-h-full object-contain transition-all duration-500 opacity-100"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($partner->nom) }}&background=purple&color=fff&size=128'">
                            @endif
                        </div>
                    </div>
                    @endforeach
                    
                    <!-- Duplication pour effet infini -->
                    @foreach($partners as $partner)
                    <div class="partner-item flex-shrink-0 group relative z-40">
                        <div class="w-48 h-32 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 flex items-center justify-center p-6 border border-gray-200 hover:border-purple-400 transform hover:scale-110 hover:-translate-y-2 relative z-40">
                            @if($partner->site_web)
                            <a href="{{ $partner->site_web }}" target="_blank" rel="noopener" class="w-full h-full flex items-center justify-center">
                                <img src="{{ $partner->logo_url ? (str_starts_with($partner->logo_url, 'http') ? $partner->logo_url : asset($partner->logo_url)) : 'https://ui-avatars.com/api/?name=' . urlencode($partner->nom) . '&background=purple&color=fff&size=128' }}" 
                                     alt="{{ $partner->nom }}" 
                                     class="max-w-full max-h-full object-contain transition-all duration-500 opacity-100"
                                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($partner->nom) }}&background=purple&color=fff&size=128'">
                            </a>
                            @else
                            <img src="{{ $partner->logo_url ? (str_starts_with($partner->logo_url, 'http') ? $partner->logo_url : asset($partner->logo_url)) : 'https://ui-avatars.com/api/?name=' . urlencode($partner->nom) . '&background=purple&color=fff&size=128' }}" 
                                 alt="{{ $partner->nom }}" 
                                 class="max-w-full max-h-full object-contain transition-all duration-500 opacity-100"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($partner->nom) }}&background=purple&color=fff&size=128'">
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <!-- Message si aucun partenaire -->
        <div class="text-center py-12 bg-white/50 rounded-2xl border-2 border-dashed border-purple-200">
            <svg class="w-16 h-16 mx-auto text-purple-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
            </svg>
            <p class="text-gray-500 text-lg mb-2">Aucun partenaire disponible</p>
            <p class="text-gray-400 text-sm">Ajoutez des partenaires depuis l'administration</p>
        </div>
        @endif
    </div>
</section>

@push('styles')
<style>
    @keyframes scroll {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }
    
    .animate-scroll {
        animation: scroll 30s linear infinite;
        display: flex;
    }
    
    .animate-scroll:hover {
        animation-play-state: paused;
    }
    
    .partner-item {
        transition: all 0.3s ease;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .partners-slider {
            animation-duration: 20s;
        }
        
        .partner-item > div {
            width: 8rem;
            height: 6rem;
        }
        
        button[onclick*="scrollPartners"] {
            width: 2.5rem;
            height: 2.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Variables globales pour le slider
    if (!window.partnersSliderVars) {
        window.partnersSliderVars = {
            currentPosition: 0,
            isPaused: false,
            restartTimer: null
        };
    }
    
    // Fonction pour récupérer la position X actuelle
    function getCurrentXPosition() {
        const slider = document.getElementById('partners-slider');
        if (!slider) return 0;
        
        const computedStyle = window.getComputedStyle(slider);
        const transform = computedStyle.transform || computedStyle.webkitTransform;
        
        if (transform && transform !== 'none') {
            const matrix = transform.match(/matrix\(([^)]+)\)/);
            if (matrix) {
                const values = matrix[1].split(',').map(v => parseFloat(v.trim()));
                return values[4] || 0;
            }
        }
        return 0;
    }
    
    // Déclarer la fonction globalement pour être accessible depuis onclick
    window.scrollPartners = function(direction) {
        const vars = window.partnersSliderVars;
        const slider = document.getElementById('partners-slider');
        
        if (!slider) {
            console.error('Slider not found');
            return;
        }
        
        // Arrête complètement l'animation CSS
        slider.style.animation = 'none';
        slider.style.animationPlayState = 'paused';
        vars.isPaused = true;
        
        // Annule tous les timers
        if (vars.restartTimer) {
            clearTimeout(vars.restartTimer);
        }
        
        // Récupère TOUJOURS la position actuelle depuis le transform
        vars.currentPosition = getCurrentXPosition();
        
        // Calcule le déplacement (240px = largeur item + espacement)
        const scrollAmount = 240 * direction;
        vars.currentPosition -= scrollAmount;
        
        // Applique le défilement avec transition
        slider.style.transition = 'transform 0.5s ease-out';
        slider.style.transform = `translateX(${vars.currentPosition}px)`;
        
        // Gère l'effet infini
        const sliderWidth = slider.scrollWidth / 2;
        if (Math.abs(vars.currentPosition) >= sliderWidth) {
            vars.currentPosition = vars.currentPosition % sliderWidth;
            if (vars.currentPosition > 0) vars.currentPosition -= sliderWidth;
            
            setTimeout(() => {
                slider.style.transition = 'none';
                slider.style.transform = `translateX(${vars.currentPosition}px)`;
            }, 500);
        }
        
        // Reprend l'animation automatique après 5 secondes
        vars.restartTimer = setTimeout(() => {
            vars.isPaused = false;
            
            // Remet l'animation CSS depuis le début
            slider.style.transition = 'none';
            slider.style.transform = 'translateX(0px)';
            vars.currentPosition = 0;
            
            setTimeout(() => {
                slider.style.animation = 'scroll 30s linear infinite';
                slider.style.transform = '';
            }, 100);
        }, 5000);
    };
    
    // Initialisation
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('partners-slider');
        if (slider) {
            const container = slider.closest('.relative');
            
            // Initialise les variables si nécessaire
            if (!window.partnersSliderVars) {
                window.partnersSliderVars = {
                    currentPosition: 0,
                    isPaused: false,
                    restartTimer: null
                };
            }
            
            // Pause au survol
            container.addEventListener('mouseenter', function() {
                if (!window.partnersSliderVars.isPaused) {
                    slider.style.animationPlayState = 'paused';
                }
            });
            
            container.addEventListener('mouseleave', function() {
                if (!window.partnersSliderVars.isPaused) {
                    slider.style.animationPlayState = 'running';
                }
            });
        }
    });
</script>
@endpush

<!-- Contact Section -->
<section id="contact" class="py-20 bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Lançons ensemble votre activité
            </h2>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                Nous serons à vos côtés à chaque étape pour révéler votre identité de marque
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Formulaire de contact -->
            <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20">
                <h3 class="text-2xl font-bold mb-6">Prendre contact</h3>
                <form action="{{ route('home') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <input type="text" name="first_name" placeholder="Prénom" required class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:border-purple-400 transition-colors">
                        <input type="text" name="last_name" placeholder="Nom" required class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:border-purple-400 transition-colors">
                    </div>
                    <input type="email" name="email" placeholder="Email" required class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:border-purple-400 transition-colors">
                    <input type="text" name="subject" placeholder="Objet" required class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:border-purple-400 transition-colors">
                    <textarea name="message" placeholder="Message" rows="4" required class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:border-purple-400 transition-colors resize-none"></textarea>
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
                        @if(!empty($siteSettings?->email))
                        <div class="flex items-center space-x-4 group">
                            <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Email</p>
                                <a href="mailto:{{ $siteSettings->email }}" class="text-gray-300 hover:text-purple-300 transition-colors">{{ $siteSettings->email }}</a>
                            </div>
                        </div>
                        @endif
                        
                        @if(!empty($siteSettings?->telephone))
                        <div class="flex items-center space-x-4 group">
                            <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Téléphone</p>
                                <a href="tel:{{ preg_replace('/\s+/', '', $siteSettings->telephone) }}" class="text-gray-300 hover:text-purple-300 transition-colors">{{ $siteSettings->telephone }}</a>
                            </div>
                        </div>
                        @endif
                        
                        @php($adresseComplete = collect([$siteSettings?->adresse, $siteSettings?->code_postal, $siteSettings?->ville, $siteSettings?->pays])->filter()->implode(', '))
                        @if(!empty($adresseComplete))
                        <div class="flex items-center space-x-4 group">
                            <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Localisation</p>
                                <p class="text-gray-300">{{ $adresseComplete }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-2xl border border-white/20">
                    <h4 class="font-bold text-xl mb-4">Prendre RDV gratuit</h4>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        Réservez un appel découverte de 30 minutes pour échanger sur votre projet et découvrir comment ZEEEMAX peut vous aider.
                    </p>
                </div>
                
                <!-- Réseaux sociaux -->
                @if(!empty($siteSettings?->facebook) || !empty($siteSettings?->instagram) || !empty($siteSettings?->linkedin) || !empty($siteSettings?->twitter) || !empty($siteSettings?->youtube))
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-2xl border border-white/20">
                    <h4 class="font-bold text-xl mb-4">Suivez-nous</h4>
                    <div class="flex space-x-4">
                        @if(!empty($siteSettings->facebook))
                        <a href="{{ $siteSettings->facebook }}" target="_blank" rel="noopener noreferrer" class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center hover:bg-purple-700 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        @endif
                        @if(!empty($siteSettings->instagram))
                        <a href="{{ $siteSettings->instagram }}" target="_blank" rel="noopener noreferrer" class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center hover:bg-purple-700 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        @endif
                        @if(!empty($siteSettings->linkedin))
                        <a href="{{ $siteSettings->linkedin }}" target="_blank" rel="noopener noreferrer" class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center hover:bg-purple-700 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                        @endif
                        @if(!empty($siteSettings->twitter))
                        <a href="{{ $siteSettings->twitter }}" target="_blank" rel="noopener noreferrer" class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center hover:bg-purple-700 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        @endif
                        @if(!empty($siteSettings->youtube))
                        <a href="{{ $siteSettings->youtube }}" target="_blank" rel="noopener noreferrer" class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center hover:bg-purple-700 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
