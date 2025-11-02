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
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold mb-6 leading-tight opacity-0 animate-fade-in-up title-gradient-glass">
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
               class="inline-block bg-brand text-white px-10 py-4 rounded-full text-lg font-bold bg-brand-hover transition-all duration-300 shadow-xl hover:shadow-2xl hover:scale-105 uppercase tracking-wide">
                {{ $homepage->bouton_texte }}
            </a>
        </div>
        @else
        <div class="opacity-0 animate-fade-in-up animation-delay-400">
            <a href="#services" class="inline-block bg-brand text-white px-10 py-4 rounded-full text-lg font-bold bg-brand-hover transition-all duration-300 shadow-xl hover:shadow-2xl hover:scale-105 uppercase tracking-wide">
                Découvrir mes services
            </a>
        </div>
        @endif
    </div>
</section>

<!-- À propos Section -->
<section id="apropos" class="relative py-20 overflow-hidden">
    <!-- Background animé glassmorphism -->
    <div class="absolute inset-0 bg-gradient-to-br from-white via-blue-50/20 to-white" style="background: linear-gradient(to bottom right, white, rgba(99, 102, 241, 0.2), rgba(158, 16, 171, 0.2));"></div>
    <div class="absolute inset-0 overflow-hidden">
        <!-- Grille de particules animées élégante -->
        <div id="anime-particles-container" class="absolute inset-0 w-full h-full pointer-events-none" style="z-index: 1;"></div>
        
        <!-- Orbes flottantes avec effet glassmorphism -->
        <div id="anime-orb-1" class="absolute top-20 right-20 w-64 h-64 rounded-full blur-2xl pointer-events-none" style="background: radial-gradient(circle, rgba(158, 16, 171, 0.35), rgba(236, 72, 153, 0.2)); z-index: 1; opacity: 0.6;"></div>
        <div id="anime-orb-2" class="absolute bottom-20 left-20 w-56 h-56 rounded-full blur-2xl pointer-events-none" style="background: radial-gradient(circle, rgba(99, 102, 241, 0.35), rgba(158, 16, 171, 0.2)); z-index: 1; opacity: 0.65;"></div>
        <div id="anime-orb-3" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-48 h-48 rounded-full blur-2xl pointer-events-none" style="background: radial-gradient(circle, rgba(158, 16, 171, 0.32), rgba(236, 72, 153, 0.25)); z-index: 1; opacity: 0.7;"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center lg:py-20">
            <!-- Content -->
            <div class="lg:pr-12">
                <h2 class="text-2xl md:text-3xl font-extrabold mb-6 tracking-tight title-gradient-glass-sm">
                    <span class="text-brand">ZEEEMAX</span>: Révélez votre identité,<br class="hidden sm:block">faîtes rayonner votre projet.
                </h2>
                <div class="space-y-6 text-gray-600 leading-relaxed text-lg">
                    <p class="font-light">
                        <strong class="font-semibold text-gray-900">ZEEEMAX est né d’une envie profonde :</strong> aider les entrepreneur(e)s à révéler leur identité, construire une image de marque forte et faire rayonner leur projet avec impact.
                    </p>
                    <p class="font-light">
                        Forte d'une expérience de terrain et diplômée en <strong class="font-semibold text-gray-900">stratégie marketing & communication</strong>, j'accompagne les marques à clarifier leur positionnement et gagner en visibilité.
                    </p>
                    <div class="pt-4">
                        <a href="#contact" class="inline-block bg-brand text-white px-8 py-3 rounded-full text-base font-bold bg-brand-hover transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 uppercase tracking-wide">
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
<section id="services" class="relative py-24 overflow-hidden">
    <!-- Background animé glassmorphism -->
    <div class="absolute inset-0" style="background: linear-gradient(to bottom right, rgba(158, 16, 171, 0.1), rgba(236, 72, 153, 0.1), rgba(99, 102, 241, 0.1));"></div>
    <div class="absolute inset-0 overflow-hidden">
        <!-- Formes animées glassmorphism -->
        <div class="absolute top-20 left-10 w-72 h-72 rounded-full blur-3xl animate-float-glass" style="background: linear-gradient(to bottom right, rgba(158, 16, 171, 0.2), rgba(236, 72, 153, 0.2));"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 rounded-full blur-3xl animate-float-glass-delayed" style="background: linear-gradient(to bottom right, rgba(99, 102, 241, 0.2), rgba(158, 16, 171, 0.2));"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-gradient-to-br from-pink-400/15 to-yellow-400/15 rounded-full blur-3xl animate-pulse-glass"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-20">
            <p class="text-brand font-bold uppercase tracking-widest text-sm mb-4">Découvrez nos services</p>
            <h2 class="text-4xl md:text-5xl font-black mb-6 tracking-tight title-gradient-glass">
                Choisissez votre point de départ
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto font-light">
                Des solutions sur-mesure pour révéler votre identité et faire rayonner votre marque
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="group bg-white p-10 rounded-2xl border border-gray-200 hover:shadow-2xl transition-all duration-300" style="border-color: rgba(158, 16, 171, 0.2);">
                <div class="icon-3d-gradient w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-all duration-300">
                    <div class="icon-svg-wrapper">
                    {!! $service->icone_svg !!}
                    </div>
                </div>
                <h3 class="text-2xl font-black mb-4 tracking-tight title-gradient-glass-sm">{{ $service->titre }}</h3>
                <p class="text-gray-600 mb-8 leading-relaxed font-light">
                    {{ $service->description }}
                </p>
                <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center text-brand font-bold text-brand-hover transition-colors group">
                    Commencer
                    <div class="icon-3d-gradient w-5 h-5 ml-2 rounded flex items-center justify-center group-hover:translate-x-1 transition-all duration-300">
                        <div class="icon-svg-wrapper">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                        </div>
                    </div>
                                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Clients Satisfaits Section -->
<section id="clients-satisfaits" class="relative py-20 overflow-hidden bg-white">
    <!-- Background animé glassmorphism -->
    @include('partials.anime-background')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative" style="z-index: 20;">
        <div class="text-center mb-16">
            <p class="text-brand font-bold uppercase tracking-widest text-sm mb-4">Ils nous font confiance</p>
            <h2 class="text-4xl md:text-5xl font-black mb-6 tracking-tight title-gradient-glass">
                Nos clients satisfaits
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto font-light">
                Des entreprises et entrepreneurs qui nous font confiance pour révéler leur identité
            </p>
        </div>
        
        @if(isset($clients) && $clients->count() > 0)
        <div x-data="{
            currentIndex: 0,
            clients: {{ $clients->map(function($client) { return ['id' => $client->id, 'nom' => $client->nom, 'type' => $client->type, 'logo_url' => str_starts_with($client->logo_url ?? '', 'http') ? $client->logo_url : ($client->logo_url ? asset($client->logo_url) : null)]; })->values()->toJson() }},
            itemsPerView: 6,
            get maxIndex() {
                return Math.max(0, this.clients.length - this.itemsPerView);
            },
            get translateX() {
                // Calcule le pourcentage de translation basé sur le nombre de clients déplacés
                // Chaque client prend (100 / itemsPerView)% de l'espace
                const clientWidth = 100 / this.itemsPerView;
                return this.currentIndex * clientWidth;
            },
            nextSlide() {
                if (this.currentIndex < this.maxIndex) {
                    this.currentIndex++;
                }
            },
            prevSlide() {
                if (this.currentIndex > 0) {
                    this.currentIndex--;
                }
            },
            updateItemsPerView() {
                if (window.innerWidth < 640) {
                    this.itemsPerView = 2;
                } else if (window.innerWidth < 1024) {
                    this.itemsPerView = 3;
                } else {
                    this.itemsPerView = 6;
                }
                // Ajuster currentIndex si nécessaire après changement de taille
                if (this.currentIndex > this.maxIndex) {
                    this.currentIndex = this.maxIndex;
                }
            },
            init() {
                this.updateItemsPerView();
                window.addEventListener('resize', () => this.updateItemsPerView());
            }
        }" class="relative">
            <!-- Slider Container -->
            <div class="relative overflow-hidden rounded-2xl">
                <!-- Slides Wrapper -->
                <div class="flex transition-transform duration-500 ease-in-out" 
                     :style="`transform: translateX(-${translateX}%)`">
                    <template x-for="(client, index) in clients" :key="client.id">
                        <div class="flex-shrink-0" :style="`width: ${100 / itemsPerView}%`">
                            <div class="px-2">
                                <div class="group flex flex-col items-center justify-center p-6 rounded-2xl bg-gray-50 hover:bg-white border-2 border-gray-100 hover:border-brand transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                                    <!-- Logo/Initiale du client -->
                                    <div class="w-20 h-20 rounded-full bg-black flex items-center justify-center text-white font-bold text-2xl mb-4 group-hover:scale-110 transition-transform duration-300 ring-4 ring-gray-100 group-hover:ring-gray-200 overflow-hidden">
                                        <template x-if="client.logo_url">
                                            <img :src="client.logo_url" :alt="client.nom" class="w-full h-full object-cover" onerror="this.parentElement.innerHTML='<span>'+client.nom.charAt(0).toUpperCase()+'</span>'">
                                        </template>
                                        <template x-if="!client.logo_url">
                                            <span x-text="client.nom.charAt(0).toUpperCase()"></span>
                                        </template>
                                    </div>
                                    <!-- Nom du client -->
                                    <h3 class="text-lg font-bold text-gray-900 mb-1 text-center" x-text="client.nom"></h3>
                                    <!-- Type -->
                                    <p class="text-sm text-gray-500 text-center font-light" x-text="client.type || ''"></p>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            
            <!-- Navigation Arrows -->
            <button 
                @click="prevSlide()"
                :disabled="currentIndex === 0"
                :class="currentIndex === 0 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-brand hover:text-white'"
                class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 w-12 h-12 rounded-full bg-white border-2 border-gray-200 flex items-center justify-center text-gray-600 transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2 z-30">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            
            <button 
                @click="nextSlide()"
                :disabled="currentIndex >= maxIndex"
                :class="currentIndex >= maxIndex ? 'opacity-50 cursor-not-allowed' : 'hover:bg-brand hover:text-white'"
                class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 w-12 h-12 rounded-full bg-white border-2 border-gray-200 flex items-center justify-center text-gray-600 transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2 z-30">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
        @else
        <div class="text-center py-12 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-300">
            <div class="icon-3d-gradient w-16 h-16 mx-auto rounded-xl flex items-center justify-center mb-4">
                <div class="icon-svg-wrapper">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
            <p class="text-gray-500 text-lg mb-2">Aucun client disponible</p>
        </div>
        @endif
    </div>
</section>

<!-- Portfolio Section -->
<section id="portfolio" class="relative py-24 overflow-hidden">
    <!-- Background animé glassmorphism -->
    <div class="absolute inset-0" style="background: linear-gradient(to bottom right, white, rgba(158, 16, 171, 0.3), rgba(99, 102, 241, 0.3));"></div>
    <div class="absolute inset-0 overflow-hidden">
        <!-- Formes animées glassmorphism -->
        <div class="absolute top-10 right-20 w-64 h-64 rounded-3xl blur-2xl rotate-45 animate-rotate-glass" style="background: linear-gradient(to bottom right, rgba(158, 16, 171, 0.25), rgba(99, 102, 241, 0.25));"></div>
        <div class="absolute bottom-10 left-20 w-80 h-80 rounded-full blur-3xl animate-float-glass-slow" style="background: linear-gradient(to bottom right, rgba(236, 72, 153, 0.2), rgba(158, 16, 171, 0.2));"></div>
        <div class="absolute top-1/3 right-1/4 w-56 h-56 bg-gradient-to-br from-blue-400/20 to-cyan-400/20 rounded-2xl blur-2xl animate-pulse-glass-slow"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-20">
            <p class="text-brand font-bold uppercase tracking-widest text-sm mb-4">Mes réalisations</p>
            <h2 class="text-4xl md:text-5xl font-black mb-6 tracking-tight title-gradient-glass">
                Découvrez nos projets à succès
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto font-light">
                Un aperçu de mon travail avec des entrepreneurs passionnés.
            </p>
        </div>
        
        @if(isset($portfolioItems) && $portfolioItems->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($portfolioItems as $item)
            <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <img src="{{ str_starts_with($item->image_url, 'http') ? $item->image_url : asset($item->image_url) }}" alt="{{ $item->titre }}" class="w-full h-64 object-cover object-center transition-transform duration-300 group-hover:scale-105">
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $item->titre }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ $item->categorie }}</p>
                    <p class="text-gray-700 leading-relaxed font-light mb-6">{{ $item->description }}</p>
                    <a href="{{ route('portfolio.show', $item->slug) }}" class="inline-flex items-center text-brand font-bold text-brand-hover transition-colors group">
                        Voir le projet
                        <div class="icon-3d-gradient w-5 h-5 ml-2 rounded flex items-center justify-center group-hover:translate-x-1 transition-all duration-300">
                            <div class="icon-svg-wrapper">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-300">
            <div class="icon-3d-gradient w-16 h-16 mx-auto rounded-xl flex items-center justify-center mb-4">
                <div class="icon-svg-wrapper">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
            </div>
            <p class="text-gray-500 text-lg mb-2">Aucun projet disponible</p>
            <p class="text-gray-400 text-sm">Exécutez le seeder pour ajouter des projets de test : <code class="bg-gray-200 px-2 py-1 rounded">php artisan db:seed --class=TestDataSeeder</code></p>
        </div>
        @endif
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
            <h2 class="text-4xl md:text-5xl font-black mb-6 tracking-tight title-gradient-glass-white">
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
                            <div class="icon-3d-gradient w-20 h-20 rounded-full flex items-center justify-center font-bold text-3xl mb-4"
                                 x-text="testimonial.name.substring(0, 1)">
                                <div class="icon-svg-wrapper text-white" x-text="testimonial.name.substring(0, 1)"></div>
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
                            :class="currentIndex === index ? 'bg-brand' : 'bg-gray-400'"
                            class="w-3 h-3 rounded-full transition-colors duration-300"></button>
                </template>
            </div>
        </div>
    </div>
</section>

<!-- Partenaires Section - Slider Glassmorphism Automatique -->
<section id="partners-section" class="relative py-24 overflow-hidden">
    <!-- Background avec gradient animé -->
    <div class="absolute inset-0" style="background: linear-gradient(to bottom right, rgba(158, 16, 171, 0.1), rgba(236, 72, 153, 0.1), rgba(99, 102, 241, 0.1));"></div>
    <div class="absolute inset-0 overflow-hidden">
        <!-- Cercles décoratifs animés -->
        <div class="absolute -top-40 -left-40 w-80 h-80 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob" style="background-color: rgba(158, 16, 171, 0.2);"></div>
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-40 left-1/2 transform -translate-x-1/2 w-80 h-80 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-4000"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <p class="text-brand font-bold uppercase tracking-widest text-sm mb-4">Nos Partenaires</p>
            <h2 class="text-4xl md:text-5xl font-black mb-6 tracking-tight title-gradient-glass">
                Ils nous font confiance
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto font-light">
                Des entreprises qui nous font confiance pour leur identité de marque
            </p>
        </div>
        
        @if(isset($partners) && $partners->count() > 0)
        <!-- Slider automatique avec effet glassmorphism -->
        <div class="relative">
            <!-- Masques gradient pour effet fade -->
            <div class="absolute left-0 top-0 bottom-0 w-32 z-20 pointer-events-none" style="background: linear-gradient(to right, rgba(158, 16, 171, 0.1), transparent);"></div>
            <div class="absolute right-0 top-0 bottom-0 w-32 z-20 pointer-events-none" style="background: linear-gradient(to left, rgba(158, 16, 171, 0.1), transparent);"></div>
            
            <!-- Container du slider -->
            <div id="partners-slider-container" class="overflow-hidden py-4">
                <div id="partners-slider" class="partners-slider-glass flex gap-6 animate-scroll-infinite">
                    <!-- Première série -->
                    @foreach($partners as $partner)
                    <div class="flex-shrink-0 w-[280px] sm:w-[320px] md:w-[360px]">
                        <div class="group relative h-[240px] sm:h-[260px] md:h-[280px] rounded-3xl bg-white/20 backdrop-blur-xl border border-white/30 shadow-xl hover:shadow-2xl transition-all duration-500 hover:scale-105 overflow-hidden" style="border-color: rgba(158, 16, 171, 0.3);">
                            <!-- Effet de brillance au survol -->
                            <div class="absolute inset-0 transition-all duration-500" style="background: linear-gradient(to bottom right, rgba(158, 16, 171, 0), rgba(236, 72, 153, 0), rgba(99, 102, 241, 0));"></div>
                            
                            <!-- Contenu -->
                            <div class="relative h-full flex flex-col items-center justify-center p-6 sm:p-8">
                            @if($partner->site_web)
                                <a href="{{ $partner->site_web }}" target="_blank" rel="noopener" class="w-full h-full flex flex-col items-center justify-center group/link">
                                    <div class="relative w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36 mb-4 flex items-center justify-center transition-transform duration-500 group-hover/link:scale-110">
                                <img src="{{ $partner->logo_url ? (str_starts_with($partner->logo_url, 'http') ? $partner->logo_url : asset($partner->logo_url)) : 'https://ui-avatars.com/api/?name=' . urlencode($partner->nom) . '&background=9e10ab&color=fff&size=128' }}" 
                                     alt="{{ $partner->nom }}" 
                                             class="max-w-full max-h-full object-contain filter drop-shadow-lg transition-all duration-500 group-hover/link:drop-shadow-2xl"
                                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($partner->nom) }}&background=9e10ab&color=fff&size=128'">
                                    </div>
                                    @if($partner->description)
                                    <p class="text-gray-700 text-xs sm:text-sm text-center font-light leading-relaxed opacity-0 group-hover/link:opacity-100 transition-opacity duration-500 max-w-xs">
                                        {{ \Illuminate\Support\Str::limit($partner->description, 70) }}
                                    </p>
                                    @endif
                                    <span class="mt-3 text-brand text-xs font-semibold uppercase tracking-wider opacity-0 group-hover/link:opacity-100 transition-opacity duration-500 flex items-center gap-2">
                                        Visiter
                                        <div class="icon-3d-gradient w-4 h-4 rounded flex items-center justify-center transform group-hover/link:translate-x-1 transition-all duration-300">
                                            <div class="icon-svg-wrapper">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </span>
                            </a>
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center">
                                    <div class="relative w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36 mb-4 flex items-center justify-center transition-transform duration-500 group-hover:scale-110">
                            <img src="{{ $partner->logo_url ? (str_starts_with($partner->logo_url, 'http') ? $partner->logo_url : asset($partner->logo_url)) : 'https://ui-avatars.com/api/?name=' . urlencode($partner->nom) . '&background=9e10ab&color=fff&size=128' }}" 
                                 alt="{{ $partner->nom }}" 
                                             class="max-w-full max-h-full object-contain filter drop-shadow-lg transition-all duration-500 group-hover:drop-shadow-2xl"
                                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($partner->nom) }}&background=9e10ab&color=fff&size=128'">
                                    </div>
                                    @if($partner->description)
                                    <p class="text-gray-700 text-xs sm:text-sm text-center font-light leading-relaxed opacity-0 group-hover:opacity-100 transition-opacity duration-500 max-w-xs">
                                        {{ \Illuminate\Support\Str::limit($partner->description, 70) }}
                                    </p>
                                    @endif
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    <!-- Duplication pour effet infini -->
                    @foreach($partners as $partner)
                    <div class="flex-shrink-0 w-[280px] sm:w-[320px] md:w-[360px]">
                        <div class="group relative h-[240px] sm:h-[260px] md:h-[280px] rounded-3xl bg-white/20 backdrop-blur-xl border border-white/30 shadow-xl hover:shadow-2xl transition-all duration-500 hover:scale-105 overflow-hidden" style="border-color: rgba(158, 16, 171, 0.3);">
                            <!-- Effet de brillance au survol -->
                            <div class="absolute inset-0 transition-all duration-500" style="background: linear-gradient(to bottom right, rgba(158, 16, 171, 0), rgba(236, 72, 153, 0), rgba(99, 102, 241, 0));"></div>
                            
                            <!-- Contenu -->
                            <div class="relative h-full flex flex-col items-center justify-center p-6 sm:p-8">
                            @if($partner->site_web)
                                <a href="{{ $partner->site_web }}" target="_blank" rel="noopener" class="w-full h-full flex flex-col items-center justify-center group/link">
                                    <div class="relative w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36 mb-4 flex items-center justify-center transition-transform duration-500 group-hover/link:scale-110">
                                <img src="{{ $partner->logo_url ? (str_starts_with($partner->logo_url, 'http') ? $partner->logo_url : asset($partner->logo_url)) : 'https://ui-avatars.com/api/?name=' . urlencode($partner->nom) . '&background=9e10ab&color=fff&size=128' }}" 
                                     alt="{{ $partner->nom }}" 
                                             class="max-w-full max-h-full object-contain filter drop-shadow-lg transition-all duration-500 group-hover/link:drop-shadow-2xl"
                                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($partner->nom) }}&background=9e10ab&color=fff&size=128'">
                                    </div>
                                    @if($partner->description)
                                    <p class="text-gray-700 text-xs sm:text-sm text-center font-light leading-relaxed opacity-0 group-hover/link:opacity-100 transition-opacity duration-500 max-w-xs">
                                        {{ \Illuminate\Support\Str::limit($partner->description, 70) }}
                                    </p>
                                    @endif
                                    <span class="mt-3 text-brand text-xs font-semibold uppercase tracking-wider opacity-0 group-hover/link:opacity-100 transition-opacity duration-500 flex items-center gap-2">
                                        Visiter
                                        <div class="icon-3d-gradient w-4 h-4 rounded flex items-center justify-center transform group-hover/link:translate-x-1 transition-all duration-300">
                                            <div class="icon-svg-wrapper">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </span>
                            </a>
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center">
                                    <div class="relative w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36 mb-4 flex items-center justify-center transition-transform duration-500 group-hover:scale-110">
                            <img src="{{ $partner->logo_url ? (str_starts_with($partner->logo_url, 'http') ? $partner->logo_url : asset($partner->logo_url)) : 'https://ui-avatars.com/api/?name=' . urlencode($partner->nom) . '&background=9e10ab&color=fff&size=128' }}" 
                                 alt="{{ $partner->nom }}" 
                                             class="max-w-full max-h-full object-contain filter drop-shadow-lg transition-all duration-500 group-hover:drop-shadow-2xl"
                                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($partner->nom) }}&background=9e10ab&color=fff&size=128'">
                                    </div>
                                    @if($partner->description)
                                    <p class="text-gray-700 text-xs sm:text-sm text-center font-light leading-relaxed opacity-0 group-hover:opacity-100 transition-opacity duration-500 max-w-xs">
                                        {{ \Illuminate\Support\Str::limit($partner->description, 70) }}
                                    </p>
                                    @endif
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <!-- Message si aucun partenaire -->
        <div class="text-center py-16 rounded-3xl bg-white/20 backdrop-blur-xl border border-white/30 shadow-xl">
            <svg class="w-20 h-20 mx-auto mb-6" style="color: rgba(158, 16, 171, 0.5);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
            </svg>
            <p class="text-gray-700 text-lg mb-2 font-semibold">Aucun partenaire disponible</p>
            <p class="text-gray-600 text-sm">Ajoutez des partenaires depuis l'administration</p>
        </div>
        @endif
    </div>
</section>

@push('styles')
<style>
    /* Classes personnalisées pour la couleur principale #9e10ab */
    .bg-brand {
        background-color: #9e10ab;
    }
    
    .bg-brand-hover:hover {
        background-color: #8e0e9a;
    }
    
    .text-brand {
        color: #9e10ab;
    }
    
    .text-brand-hover:hover {
        color: #8e0e9a;
    }
    
    .border-brand {
        border-color: rgba(158, 16, 171, 0.5);
    }
    
    .border-brand-hover:hover {
        border-color: rgba(158, 16, 171, 0.8);
    }
    
    .focus-border-brand:focus {
        border-color: #9e10ab !important;
        outline: none;
    }
    
    /* Animation blob pour le background */
    @keyframes blob {
        0% {
            transform: translate(0px, 0px) scale(1);
        }
        33% {
            transform: translate(30px, -50px) scale(1.1);
        }
        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }
        100% {
            transform: translate(0px, 0px) scale(1);
        }
    }
    
    .animate-blob {
        animation: blob 7s infinite;
    }
    
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    
    .animation-delay-4000 {
        animation-delay: 4s;
    }
    
    /* Animation slider automatique infinie */
    @keyframes scroll-infinite {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }
    
    .animate-scroll-infinite {
        animation: scroll-infinite 25s linear infinite;
        will-change: transform;
    }
    
    /* Pause au survol pour meilleure UX */
    #partners-section:hover .animate-scroll-infinite,
    #partners-slider-container:hover .animate-scroll-infinite,
    #partners-slider:hover,
    .partners-slider-glass:hover .animate-scroll-infinite {
        animation-play-state: paused !important;
    }
    
    /* Support pour backdrop-blur sur Safari */
    @supports (-webkit-backdrop-filter: blur(12px)) {
        .backdrop-blur-xl {
            -webkit-backdrop-filter: blur(12px);
            backdrop-filter: blur(12px);
        }
    }
    
    /* Responsive améliorations */
    @media (max-width: 640px) {
        .animate-scroll-infinite {
            animation-duration: 20s;
        }
        
        .partners-slider-glass {
            gap: 1rem;
        }
    }
    
    /* Optimisation des performances */
    .partners-slider-glass > div {
        transform: translateZ(0);
        backface-visibility: hidden;
        perspective: 1000px;
    }
    
    /* Icônes 3D avec dégradés mauve-bleu */
    .icon-3d-gradient {
        background: linear-gradient(135deg, #9e10ab 0%, #8B5CF6 50%, #6366F1 100%);
        box-shadow: 
            0 10px 25px rgba(158, 16, 171, 0.4),
            0 5px 10px rgba(139, 92, 246, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.3),
            inset 0 -2px 10px rgba(0, 0, 0, 0.2);
        transform-style: preserve-3d;
        position: relative;
    }
    
    .icon-3d-gradient::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.3) 0%, transparent 50%, rgba(0, 0, 0, 0.1) 100%);
        border-radius: inherit;
        pointer-events: none;
    }
    
    .icon-3d-gradient:hover {
        box-shadow: 
            0 15px 35px rgba(158, 16, 171, 0.5),
            0 8px 15px rgba(139, 92, 246, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.4),
            inset 0 -2px 15px rgba(0, 0, 0, 0.3);
        transform: translateY(-2px) scale(1.1);
    }
    
    .icon-svg-wrapper {
        position: relative;
        z-index: 1;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
    }
    
    .icon-svg-wrapper svg {
        color: white;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.4));
    }
    
    .icon-3d-gradient:hover .icon-svg-wrapper svg {
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.5));
    }
    
    /* Titres avec dégradés modernes style CodAfrik */
    .title-gradient-glass {
        background: linear-gradient(135deg, #667EEA 0%, #764BA2 25%, #F093FB 50%, #F5576C 75%, #4FACFE 100%);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        font-family: 'Poppins', 'Inter', sans-serif;
        font-weight: 800;
        letter-spacing: -0.02em;
        animation: gradient-shift 10s ease infinite;
    }
    
    .title-gradient-glass-sm {
        background: linear-gradient(135deg, #667EEA 0%, #764BA2 50%, #F093FB 100%);
        background-size: 250% 250%;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        font-family: 'Poppins', 'Inter', sans-serif;
        font-weight: 700;
        letter-spacing: -0.015em;
        animation: gradient-shift 8s ease infinite;
    }
    
    .title-gradient-glass-white {
        background: linear-gradient(135deg, #FFFFFF 0%, #E0E7FF 25%, #C7D2FE 50%, #A5B4FC 75%, #FFFFFF 100%);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        font-family: 'Poppins', 'Inter', sans-serif;
        font-weight: 800;
        letter-spacing: -0.02em;
        animation: gradient-shift 10s ease infinite;
    }
    
    @keyframes gradient-shift {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }
    
    /* Animations glassmorphism pour background */
    @keyframes float-glass {
        0%, 100% {
            transform: translate(0, 0) scale(1);
            opacity: 0.6;
        }
        33% {
            transform: translate(30px, -40px) scale(1.1);
            opacity: 0.8;
        }
        66% {
            transform: translate(-20px, 30px) scale(0.9);
            opacity: 0.5;
        }
    }
    
    @keyframes float-glass-delayed {
        0%, 100% {
            transform: translate(0, 0) scale(1);
            opacity: 0.5;
        }
        50% {
            transform: translate(-40px, 50px) scale(1.15);
            opacity: 0.7;
        }
    }
    
    @keyframes float-glass-slow {
        0%, 100% {
            transform: translate(0, 0) scale(1);
            opacity: 0.4;
        }
        50% {
            transform: translate(50px, -60px) scale(1.2);
            opacity: 0.6;
        }
    }
    
    @keyframes pulse-glass {
        0%, 100% {
            transform: translate(-50%, -50%) scale(1);
            opacity: 0.3;
        }
        50% {
            transform: translate(-50%, -50%) scale(1.3);
            opacity: 0.5;
        }
    }
    
    @keyframes pulse-glass-slow {
        0%, 100% {
            transform: scale(1);
            opacity: 0.2;
        }
        50% {
            transform: scale(1.25);
            opacity: 0.4;
        }
    }
    
    @keyframes rotate-glass {
        0% {
            transform: rotate(0deg) scale(1);
            opacity: 0.3;
        }
        50% {
            transform: rotate(180deg) scale(1.1);
            opacity: 0.5;
        }
        100% {
            transform: rotate(360deg) scale(1);
            opacity: 0.3;
        }
    }
    
    .animate-float-glass {
        animation: float-glass 15s ease-in-out infinite;
    }
    
    .animate-float-glass-delayed {
        animation: float-glass-delayed 18s ease-in-out infinite;
        animation-delay: 3s;
    }
    
    .animate-float-glass-slow {
        animation: float-glass-slow 20s ease-in-out infinite;
        animation-delay: 2s;
    }
    
    .animate-pulse-glass {
        animation: pulse-glass 12s ease-in-out infinite;
    }
    
    .animate-pulse-glass-slow {
        animation: pulse-glass-slow 14s ease-in-out infinite;
        animation-delay: 4s;
    }
    
    .animate-rotate-glass {
        animation: rotate-glass 25s linear infinite;
    }
    
    /* Animations avancées pour la section À propos */
    @keyframes advanced-float {
        0% {
            transform: translate(0, 0) rotate(0deg) scale(1);
            opacity: 0.6;
        }
        25% {
            transform: translate(60px, -80px) rotate(90deg) scale(1.2);
            opacity: 0.8;
        }
        50% {
            transform: translate(-40px, 100px) rotate(180deg) scale(0.9);
            opacity: 0.7;
        }
        75% {
            transform: translate(80px, 40px) rotate(270deg) scale(1.1);
            opacity: 0.85;
        }
        100% {
            transform: translate(0, 0) rotate(360deg) scale(1);
            opacity: 0.6;
        }
    }
    
    @keyframes circular-move {
        0% {
            transform: translate(0, 0) scale(1);
            opacity: 0.5;
        }
        25% {
            transform: translate(120px, -120px) scale(1.3);
            opacity: 0.7;
        }
        50% {
            transform: translate(-120px, -120px) scale(0.8);
            opacity: 0.6;
        }
        75% {
            transform: translate(-120px, 120px) scale(1.2);
            opacity: 0.75;
        }
        100% {
            transform: translate(0, 0) scale(1);
            opacity: 0.5;
        }
    }
    
    @keyframes morphing-shape {
        0%, 100% {
            transform: translate(-50%, -50%) scale(1) rotate(0deg);
            border-radius: 50%;
            opacity: 0.6;
        }
        25% {
            transform: translate(-50%, -50%) scale(1.2) rotate(90deg);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            opacity: 0.8;
        }
        50% {
            transform: translate(-50%, -50%) scale(0.9) rotate(180deg);
            border-radius: 40% 60% 60% 40% / 60% 30% 70% 40%;
            opacity: 0.7;
        }
        75% {
            transform: translate(-50%, -50%) scale(1.15) rotate(270deg);
            border-radius: 70% 30% 30% 70% / 30% 70% 70% 30%;
            opacity: 0.85;
        }
    }
    
    @keyframes figure-eight {
        0% {
            transform: translate(0, 0) rotate(0deg) scale(1);
            opacity: 0.5;
        }
        12.5% {
            transform: translate(80px, 0) rotate(45deg) scale(1.1);
            opacity: 0.7;
        }
        25% {
            transform: translate(0, 80px) rotate(90deg) scale(1.2);
            opacity: 0.8;
        }
        37.5% {
            transform: translate(-80px, 0) rotate(135deg) scale(1.1);
            opacity: 0.7;
        }
        50% {
            transform: translate(0, 0) rotate(180deg) scale(1);
            opacity: 0.5;
        }
        62.5% {
            transform: translate(-80px, 0) rotate(225deg) scale(1.1);
            opacity: 0.7;
        }
        75% {
            transform: translate(0, -80px) rotate(270deg) scale(1.2);
            opacity: 0.8;
        }
        87.5% {
            transform: translate(80px, 0) rotate(315deg) scale(1.1);
            opacity: 0.7;
        }
        100% {
            transform: translate(0, 0) rotate(360deg) scale(1);
            opacity: 0.5;
        }
    }
    
    @keyframes wave-motion {
        0%, 100% {
            transform: translateY(0) scale(1);
            opacity: 0.5;
        }
        25% {
            transform: translateY(-60px) scale(1.2);
            opacity: 0.7;
        }
        50% {
            transform: translateY(60px) scale(0.9);
            opacity: 0.6;
        }
        75% {
            transform: translateY(-30px) scale(1.1);
            opacity: 0.75;
        }
    }
    
    @keyframes spiral-move {
        0% {
            transform: translate(0, 0) rotate(0deg) scale(1);
            opacity: 0.5;
        }
        33% {
            transform: translate(100px, 100px) rotate(120deg) scale(1.3);
            opacity: 0.7;
        }
        66% {
            transform: translate(-100px, 100px) rotate(240deg) scale(0.8);
            opacity: 0.6;
        }
        100% {
            transform: translate(0, 0) rotate(360deg) scale(1);
            opacity: 0.5;
        }
    }
    
    @keyframes color-shift {
        0%, 100% {
            background: linear-gradient(135deg, rgba(158, 16, 171, 0.15), rgba(236, 72, 153, 0.12));
            transform: scale(1);
            opacity: 0.6;
        }
        25% {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.18), rgba(158, 16, 171, 0.15));
            transform: scale(1.2);
            opacity: 0.8;
        }
        50% {
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.15), rgba(99, 102, 241, 0.12));
            transform: scale(0.9);
            opacity: 0.7;
        }
        75% {
            background: linear-gradient(135deg, rgba(158, 16, 171, 0.18), rgba(99, 102, 241, 0.15));
            transform: scale(1.15);
            opacity: 0.75;
        }
    }
    
    .animate-advanced-float {
        animation: advanced-float 20s ease-in-out infinite;
    }
    
    .animate-circular-move {
        animation: circular-move 25s ease-in-out infinite;
        animation-delay: 2s;
    }
    
    .animate-morphing-shape {
        animation: morphing-shape 18s ease-in-out infinite;
        animation-delay: 1s;
    }
    
    .animate-figure-eight {
        animation: figure-eight 22s ease-in-out infinite;
        animation-delay: 3s;
    }
    
    .animate-wave-motion {
        animation: wave-motion 16s ease-in-out infinite;
        animation-delay: 1.5s;
    }
    
    .animate-spiral-move {
        animation: spiral-move 24s ease-in-out infinite;
        animation-delay: 4s;
    }
    
    .animate-color-shift {
        animation: color-shift 20s ease-in-out infinite;
        animation-delay: 2.5s;
    }
    
    /* Amélioration des fonts pour tout le site */
    body {
        font-family: 'Inter', 'Poppins', sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-rendering: optimizeLegibility;
    }
    
    h1, h2, h3, h4, h5, h6 {
        font-family: 'Poppins', 'Inter', sans-serif;
        font-weight: 700;
        letter-spacing: -0.02em;
    }
    
    /* Support pour les navigateurs sans background-clip */
    @supports not (-webkit-background-clip: text) {
        .title-gradient-glass,
        .title-gradient-glass-sm,
        .title-gradient-glass-white {
            background: none;
            -webkit-text-fill-color: initial;
            color: #1F2937;
        }
        
        .title-gradient-glass-white {
            color: #FFFFFF;
        }
    }
</style>
@endpush

<!-- Contact Section -->
<section id="contact" class="relative py-20 overflow-hidden">
    <!-- Background animé glassmorphism sombre -->
    <div class="absolute inset-0" style="background: linear-gradient(to bottom right, #0a0a0a, #1a0a1f, #0a0a0a);"></div>
    <div class="absolute inset-0 overflow-hidden">
        <!-- Formes animées glassmorphism très subtiles -->
        <div class="absolute top-10 left-20 w-96 h-96 rounded-full blur-3xl animate-pulse-glass" style="background: linear-gradient(to bottom right, rgba(158, 16, 171, 0.15), rgba(236, 72, 153, 0.08));"></div>
        <div class="absolute bottom-10 right-20 w-80 h-80 rounded-full blur-3xl animate-float-glass-delayed" style="background: linear-gradient(to bottom right, rgba(99, 102, 241, 0.08), rgba(158, 16, 171, 0.12));"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] rounded-full blur-3xl animate-pulse-glass-slow" style="background: linear-gradient(to bottom right, rgba(158, 16, 171, 0.08), rgba(236, 72, 153, 0.05));"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 title-gradient-glass-white">
                Lançons ensemble votre activité
            </h2>
            <p class="text-xl text-white max-w-3xl mx-auto">
                Nous serons à vos côtés à chaque étape pour révéler votre identité de marque
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Formulaire de contact -->
            <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20">
                <h3 class="text-2xl font-bold mb-6 text-white">Prendre contact</h3>
                <form action="{{ route('home') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <input type="text" name="first_name" placeholder="Prénom" required class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-100 focus:outline-none transition-colors focus-border-brand">
                        <input type="text" name="last_name" placeholder="Nom" required class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-100 focus:outline-none transition-colors focus-border-brand">
                    </div>
                    <input type="email" name="email" placeholder="Email" required class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-100 focus:outline-none transition-colors focus-border-brand">
                    <input type="text" name="subject" placeholder="Objet" required class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-100 focus:outline-none transition-colors focus-border-brand">
                    <textarea name="message" placeholder="Message" rows="4" required class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-100 focus:outline-none transition-colors resize-none focus-border-brand"></textarea>
                    <button type="submit" class="w-full bg-brand text-white px-6 py-3 rounded-xl font-semibold bg-brand-hover transition-colors transform hover:scale-105 duration-300 shadow-lg">
                        Envoyer le message
                    </button>
                </form>
            </div>
            
            <!-- Informations de contact -->
            <div class="space-y-8">
                <div>
                    <h3 class="text-2xl font-bold mb-6 text-white">Contactez-nous</h3>
                    <div class="space-y-4">
                        @if(!empty($siteSettings?->email))
                        <div class="flex items-center space-x-4 group">
                            <div class="icon-3d-gradient w-12 h-12 rounded-xl flex items-center justify-center group-hover:scale-110 transition-all duration-300">
                                <div class="icon-svg-wrapper">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                </div>
                            </div>
                            <div>
                                <p class="font-semibold text-white">Email</p>
                                <a href="mailto:{{ $siteSettings->email }}" class="text-white hover:text-gray-200 transition-colors">{{ $siteSettings->email }}</a>
                            </div>
                        </div>
                        @endif
                        
                        @if(!empty($siteSettings?->telephone))
                        <div class="flex items-center space-x-4 group">
                            <div class="icon-3d-gradient w-12 h-12 rounded-xl flex items-center justify-center group-hover:scale-110 transition-all duration-300">
                                <div class="icon-svg-wrapper">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                </div>
                            </div>
                            <div>
                                <p class="font-semibold text-white">Téléphone</p>
                                <a href="tel:{{ preg_replace('/\s+/', '', $siteSettings->telephone) }}" class="text-white hover:text-gray-200 transition-colors">{{ $siteSettings->telephone }}</a>
                            </div>
                        </div>
                        @endif
                        
                        @php($adresseComplete = collect([$siteSettings?->adresse, $siteSettings?->code_postal, $siteSettings?->ville, $siteSettings?->pays])->filter()->implode(', '))
                        @if(!empty($adresseComplete))
                        <div class="flex items-center space-x-4 group">
                            <div class="icon-3d-gradient w-12 h-12 rounded-xl flex items-center justify-center group-hover:scale-110 transition-all duration-300">
                                <div class="icon-svg-wrapper">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                </div>
                            </div>
                            <div>
                                <p class="font-semibold text-white">Localisation</p>
                                <p class="text-gray-100">{{ $adresseComplete }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-2xl border border-white/20">
                    <h4 class="font-bold text-xl mb-4 text-white">Prendre RDV gratuit</h4>
                    <p class="text-gray-100 mb-6 leading-relaxed">
                        Réservez un appel découverte de 30 minutes pour échanger sur votre projet et découvrir comment ZEEEMAX peut vous aider.
                    </p>
                </div>
                
                <!-- Réseaux sociaux -->
                @if(!empty($siteSettings?->facebook) || !empty($siteSettings?->instagram) || !empty($siteSettings?->linkedin) || !empty($siteSettings?->twitter) || !empty($siteSettings?->youtube))
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-2xl border border-white/20">
                    <h4 class="font-bold text-xl mb-4 text-white">Suivez-nous</h4>
                    <div class="flex space-x-4">
                        @if(!empty($siteSettings->facebook))
                        <a href="{{ $siteSettings->facebook }}" target="_blank" rel="noopener noreferrer" class="icon-3d-gradient w-12 h-12 rounded-xl flex items-center justify-center hover:scale-110 transition-all duration-300">
                            <div class="icon-svg-wrapper">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </div>
                        </a>
                        @endif
                        @if(!empty($siteSettings->instagram))
                        <a href="{{ $siteSettings->instagram }}" target="_blank" rel="noopener noreferrer" class="icon-3d-gradient w-12 h-12 rounded-xl flex items-center justify-center hover:scale-110 transition-all duration-300">
                            <div class="icon-svg-wrapper">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            </div>
                        </a>
                        @endif
                        @if(!empty($siteSettings->linkedin))
                        <a href="{{ $siteSettings->linkedin }}" target="_blank" rel="noopener noreferrer" class="icon-3d-gradient w-12 h-12 rounded-xl flex items-center justify-center hover:scale-110 transition-all duration-300">
                            <div class="icon-svg-wrapper">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            </div>
                        </a>
                        @endif
                        @if(!empty($siteSettings->twitter))
                        <a href="{{ $siteSettings->twitter }}" target="_blank" rel="noopener noreferrer" class="icon-3d-gradient w-12 h-12 rounded-xl flex items-center justify-center hover:scale-110 transition-all duration-300">
                            <div class="icon-svg-wrapper">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </div>
                        </a>
                        @endif
                        @if(!empty($siteSettings->youtube))
                        <a href="{{ $siteSettings->youtube }}" target="_blank" rel="noopener noreferrer" class="icon-3d-gradient w-12 h-12 rounded-xl flex items-center justify-center hover:scale-110 transition-all duration-300">
                            <div class="icon-svg-wrapper">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@push('scripts')
<!-- Anime.js CDN - Version moderne et légère -->
<script src="https://cdn.jsdelivr.net/npm/animejs@3.2.2/lib/anime.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Vérifier que Anime.js est chargé
    if (typeof anime === 'undefined') {
        console.error('Anime.js n\'est pas chargé');
        return;
    }

    // Créer des particules flottantes élégantes
    const particlesContainer = document.getElementById('anime-particles-container');
    if (particlesContainer) {
        const particleCount = 25; // Nombre de particules
        const particles = [];
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'anime-particle absolute rounded-full';
            const size = anime.random(20, 40);
            particle.style.width = size + 'px';
            particle.style.height = size + 'px';
            particle.style.background = `radial-gradient(circle, rgba(158, 16, 171, ${0.4 + Math.random() * 0.3}), rgba(236, 72, 153, ${0.2 + Math.random() * 0.2}))`;
            particle.style.boxShadow = `0 0 ${size * 2}px rgba(158, 16, 171, 0.4)`;
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            particle.style.opacity = '0';
            particle.style.filter = 'blur(8px)';
            particlesContainer.appendChild(particle);
            particles.push(particle);
        }
        
        // Animation avec timeline et stagger élégant
        const options = {
            grid: [5, 5],
            from: 'center',
        };
        
        anime.timeline({
            loop: true
        })
        .add({
            targets: '.anime-particle',
            opacity: [
                { value: 0.8, duration: 1500, easing: 'easeOutQuad' },
                { value: 0.5, duration: 1500, easing: 'easeInQuad' },
                { value: 0.7, duration: 1000, easing: 'easeInOutQuad' }
            ],
            scale: [
                { value: 1.2, duration: 2000, easing: 'easeInOutSine' },
                { value: 0.8, duration: 2000, easing: 'easeInOutSine' },
                { value: 1, duration: 1500, easing: 'easeInOutSine' }
            ],
            translateX: function() {
                return anime.random(-100, 100);
            },
            translateY: function() {
                return anime.random(-80, 80);
            },
            rotate: [0, 360],
            delay: anime.stagger(300, options),
            duration: 4000,
            easing: 'easeInOutQuad'
        })
        .add({
            targets: '.anime-particle',
            translateX: function() {
                return anime.random(-150, 150);
            },
            translateY: function() {
                return anime.random(-120, 120);
            },
            scale: [
                { value: 1.4, duration: 2500, easing: 'easeOutElastic(1, .8)' },
                { value: 0.7, duration: 2500, easing: 'easeInElastic(1, .8)' },
                { value: 1, duration: 2000, easing: 'easeInOutQuad' }
            ],
            rotate: [360, 720],
            delay: anime.stagger(200, options),
            duration: 5000,
            easing: 'easeInOutSine'
        }, '-=2000');
    }

    // Orbes flottantes élégantes avec trajectoires fluides
    // Orbe 1 : Mouvement elliptique élégant
    anime({
        targets: '#anime-orb-1',
        translateX: [
            { value: 120, duration: 4000, easing: 'easeInOutSine' },
            { value: -80, duration: 4000, easing: 'easeInOutSine' },
            { value: 100, duration: 4000, easing: 'easeInOutSine' },
            { value: 0, duration: 4000, easing: 'easeInOutSine' }
        ],
        translateY: [
            { value: -100, duration: 4000, easing: 'easeInOutSine' },
            { value: 80, duration: 4000, easing: 'easeInOutSine' },
            { value: -60, duration: 4000, easing: 'easeInOutSine' },
            { value: 0, duration: 4000, easing: 'easeInOutSine' }
        ],
        scale: [
            { value: 1.3, duration: 3000, easing: 'easeInOutQuad' },
            { value: 0.9, duration: 3000, easing: 'easeInOutQuad' },
            { value: 1.2, duration: 3000, easing: 'easeInOutQuad' },
            { value: 1, duration: 3000, easing: 'easeInOutQuad' }
        ],
        opacity: [
            { value: 0.8, duration: 3000, easing: 'easeInOutQuad' },
            { value: 0.5, duration: 3000, easing: 'easeInOutQuad' },
            { value: 0.75, duration: 3000, easing: 'easeInOutQuad' },
            { value: 0.6, duration: 3000, easing: 'easeInOutQuad' }
        ],
        rotate: [0, 360],
        loop: true,
        delay: 0
    });

    // Orbe 2 : Trajectoire circulaire fluide
    anime({
        targets: '#anime-orb-2',
        translateX: [
            { value: 150, duration: 5000, easing: 'easeInOutSine' },
            { value: -150, duration: 5000, easing: 'easeInOutSine' },
            { value: 0, duration: 5000, easing: 'easeInOutSine' }
        ],
        translateY: [
            { value: -150, duration: 5000, easing: 'easeInOutSine' },
            { value: 150, duration: 5000, easing: 'easeInOutSine' },
            { value: 0, duration: 5000, easing: 'easeInOutSine' }
        ],
        scale: [
            { value: 1.4, duration: 3500, easing: 'easeOutElastic(1, .7)' },
            { value: 0.8, duration: 3500, easing: 'easeInElastic(1, .7)' },
            { value: 1, duration: 3500, easing: 'easeInOutQuad' }
        ],
        opacity: [
            { value: 0.85, duration: 3500, easing: 'easeInOutQuad' },
            { value: 0.45, duration: 3500, easing: 'easeInOutQuad' },
            { value: 0.75, duration: 3500, easing: 'easeInOutQuad' }
        ],
        rotate: [0, 720],
        loop: true,
        delay: 2000
    });

    // Orbe 3 : Mouvement en spirale élégant
    anime({
        targets: '#anime-orb-3',
        translateX: [
            { value: 80, duration: 4500, easing: 'easeInOutSine' },
            { value: -100, duration: 4500, easing: 'easeInOutSine' },
            { value: 60, duration: 4500, easing: 'easeInOutSine' },
            { value: 0, duration: 4500, easing: 'easeInOutSine' }
        ],
        translateY: [
            { value: -80, duration: 4500, easing: 'easeInOutSine' },
            { value: 100, duration: 4500, easing: 'easeInOutSine' },
            { value: -60, duration: 4500, easing: 'easeInOutSine' },
            { value: 0, duration: 4500, easing: 'easeInOutSine' }
        ],
        scale: [
            { value: 1.5, duration: 3000, easing: 'easeOutElastic(1, .8)' },
            { value: 0.7, duration: 3000, easing: 'easeInElastic(1, .8)' },
            { value: 1.3, duration: 3000, easing: 'easeOutElastic(1, .8)' },
            { value: 1, duration: 3000, easing: 'easeInElastic(1, .8)' }
        ],
        opacity: [
            { value: 0.9, duration: 3000, easing: 'easeInOutQuad' },
            { value: 0.4, duration: 3000, easing: 'easeInOutQuad' },
            { value: 0.8, duration: 3000, easing: 'easeInOutQuad' },
            { value: 0.65, duration: 3000, easing: 'easeInOutQuad' }
        ],
        rotate: [0, 360],
        filter: [
            { value: 'blur(40px)', duration: 3000 },
            { value: 'blur(60px)', duration: 3000 },
            { value: 'blur(50px)', duration: 3000 },
            { value: 'blur(40px)', duration: 3000 }
        ],
        loop: true,
        delay: 3000
    });
});
</script>

<!-- Scripts pour les animations des composants partiels -->
@include('partials.anime-scripts')
@endpush

@endsection
