@extends('layouts.app')

@section('title', $service->titre . ' - ZEEEMAX')
@section('description', substr($service->description, 0, 160))

@section('content')
<!-- Hero Section -->
<section class="relative py-56 bg-gradient-to-br from-purple-900 via-purple-800 to-blue-900 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute inset-0" style="background-image: url('{{ asset('images/hero-bg.jpg') }}'); background-size: cover; background-position: center;"></div>
    </div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <div class="icon-3d-gradient w-24 h-24 rounded-2xl flex items-center justify-center mx-auto mb-6">
            <div class="icon-svg-wrapper">
            @if($service->icone_svg)
                {!! $service->getIcone() !!}
            @endif
            </div>
        </div>
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-6 leading-tight title-gradient-glass" style="opacity: 0.95;">{{ $service->titre }}</h1>
        <div class="prose prose-lg prose-invert max-w-3xl mx-auto">
            <p class="text-xl text-purple-100 leading-relaxed">{{ $service->description }}</p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="relative py-24 bg-white overflow-hidden">
    @include('partials.anime-background')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        
        <!-- Description détaillée -->
        <div class="bg-gray-50 rounded-3xl p-10 mb-12 shadow-lg">
            <h2 class="text-3xl font-bold mb-6 tracking-tight title-gradient-glass-sm">À propos de ce service</h2>
            <div class="text-gray-700 leading-relaxed text-lg">
                {{ $service->description }}
            </div>
        </div>

        <!-- Ce qui est inclus -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold mb-8 tracking-tight title-gradient-glass-sm text-center">Ce qui est inclus</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @php
                    $includes = [
                        'branding' => [
                            'Audit complet de votre identité actuelle',
                            'Création de logo sur-mesure',
                            'Charte graphique complète',
                            'Déclinaisons sur supports print et digital',
                            'Guide de style et guidelines de marque',
                            'Support et conseils post-lancement'
                        ],
                        'communication' => [
                            'Analyse de votre audience cible',
                            'Stratégie de communication personnalisée',
                            'Création de contenus engageants',
                            'Plan éditorial sur mesure',
                            'Cohérence visuelle et ton de voix',
                            'Suivi et optimisation continue'
                        ],
                        'strategie-digitale' => [
                            'Audit digital complet',
                            'Stratégie de visibilité en ligne',
                            'Optimisation SEO',
                            'Plan de communication digitale',
                            'Outils et analytics',
                            'Accompagnement personnalisé'
                        ],
                        'conception-web' => [
                            'Conception UX/UI moderne',
                            'Développement sur-mesure',
                            'Design responsive',
                            'Optimisation performance',
                            'Formation à la gestion',
                            'Support technique inclus'
                        ],
                        'application' => [
                            'Conception UI/UX mobile',
                            'Développement Android et iOS',
                            'Solution cross-platform',
                            'Tests et optimisation',
                            'Publication sur les stores',
                            'Maintenance et mises à jour'
                        ]
                    ];
                    $serviceIncludes = $includes[$service->slug] ?? [
                        'Analyse approfondie de vos besoins',
                        'Solution personnalisée sur-mesure',
                        'Accompagnement tout au long du processus',
                        'Support et suivi post-lancement',
                        'Formation et documentation',
                        'Optimisation continue'
                    ];
                @endphp
                @foreach($serviceIncludes as $index => $include)
                <div class="flex items-start gap-4 bg-white p-6 rounded-2xl border border-gray-200 hover:shadow-lg transition-all duration-300">
                    <div class="icon-3d-gradient w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0">
                        <div class="icon-svg-wrapper">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-700 font-medium text-lg">{{ $include }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Processus -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold mb-8 tracking-tight title-gradient-glass-sm text-center">Notre processus</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @php
                    $steps = [
                        [
                            'number' => '01', 
                            'title' => 'Audit & Analyse', 
                            'description' => 'Nous analysons vos besoins et votre contexte pour comprendre vos objectifs.',
                            'icon' => '<svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>'
                        ],
                        [
                            'number' => '02', 
                            'title' => 'Conception', 
                            'description' => 'Création d\'une solution personnalisée alignée avec votre vision.',
                            'icon' => '<svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>'
                        ],
                        [
                            'number' => '03', 
                            'title' => 'Développement', 
                            'description' => 'Réalisation et mise en œuvre avec un suivi régulier.',
                            'icon' => '<svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>'
                        ],
                        [
                            'number' => '04', 
                            'title' => 'Lancement & Suivi', 
                            'description' => 'Accompagnement au lancement et optimisation continue.',
                            'icon' => '<svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>'
                        ]
                    ];
                @endphp
                @foreach($steps as $step)
                <div class="relative bg-gradient-to-br from-white to-gray-50 p-6 rounded-2xl border border-gray-200 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <!-- Icône avec fond gradient -->
                    <div class="icon-3d-gradient w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <div class="icon-svg-wrapper">
                            {!! $step['icon'] !!}
                        </div>
                    </div>
                    <!-- Numéro -->
                    <div class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-br from-brand to-purple-600 mb-4 text-center" style="background: linear-gradient(135deg, rgba(158, 16, 171, 1), rgba(139, 92, 246, 1));">
                        {{ $step['number'] }}
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900 text-center">{{ $step['title'] }}</h3>
                    <p class="text-gray-600 leading-relaxed text-center">{{ $step['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Avantages -->
        <div class="mb-12 bg-gradient-to-br from-brand/10 via-purple-100/50 to-blue-100/50 rounded-3xl p-10">
            <h2 class="text-3xl font-bold mb-8 tracking-tight title-gradient-glass-sm text-center">Pourquoi choisir ce service ?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $benefits = [
                        'branding' => [
                            ['icon' => '🎯', 'title' => 'Identité unique', 'text' => 'Une marque qui vous ressemble et vous démarque'],
                            ['icon' => '✨', 'title' => 'Design professionnel', 'text' => 'Création graphique de qualité premium'],
                            ['icon' => '🚀', 'title' => 'Impact durable', 'text' => 'Une identité qui évolue avec votre entreprise']
                        ],
                        'communication' => [
                            ['icon' => '💬', 'title' => 'Messages percutants', 'text' => 'Une communication qui résonne avec votre audience'],
                            ['icon' => '📊', 'title' => 'Stratégie efficace', 'text' => 'Plans d\'action mesurables et optimisés'],
                            ['icon' => '🎨', 'title' => 'Cohérence parfaite', 'text' => 'Un ton et un style alignés sur votre marque']
                        ],
                        'strategie-digitale' => [
                            ['icon' => '📈', 'title' => 'Visibilité accrue', 'text' => 'Augmentez votre présence en ligne efficacement'],
                            ['icon' => '🎯', 'title' => 'ROI mesurable', 'text' => 'Stratégies optimisées pour de vrais résultats'],
                            ['icon' => '⚡', 'title' => 'Outils performants', 'text' => 'Solutions digitales adaptées à vos besoins']
                        ],
                        'conception-web' => [
                            ['icon' => '🌐', 'title' => 'Site moderne', 'text' => 'Design contemporain et expérience utilisateur optimale'],
                            ['icon' => '📱', 'title' => 'Responsive', 'text' => 'Parfaitement adapté à tous les appareils'],
                            ['icon' => '⚡', 'title' => 'Performant', 'text' => 'Rapidité et optimisation SEO intégrées']
                        ],
                        'application' => [
                            ['icon' => '📱', 'title' => 'Multi-plateformes', 'text' => 'Une seule solution pour Android et iOS'],
                            ['icon' => '🎨', 'title' => 'Design moderne', 'text' => 'Interface intuitive et expérience utilisateur exceptionnelle'],
                            ['icon' => '🔧', 'title' => 'Maintenance incluse', 'text' => 'Support continu et mises à jour régulières']
                        ]
                    ];
                    $serviceBenefits = $benefits[$service->slug] ?? [
                        ['icon' => '✅', 'title' => 'Solution sur-mesure', 'text' => 'Adaptée à vos besoins spécifiques'],
                        ['icon' => '💼', 'title' => 'Expertise professionnelle', 'text' => 'Accompagnement par des experts'],
                        ['icon' => '🎯', 'title' => 'Résultats garantis', 'text' => 'Engagement envers votre succès']
                    ];
                @endphp
                @foreach($serviceBenefits as $benefit)
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="text-4xl mb-4">{{ $benefit['icon'] }}</div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">{{ $benefit['title'] }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $benefit['text'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <!-- CTA Section -->
        <div class="text-center rounded-3xl p-12 text-white" style="background: linear-gradient(to bottom right, #9e10ab, #9333ea);">
            <h2 class="text-3xl font-bold mb-4 text-white">Prêt à démarrer ?</h2>
            <p class="text-xl text-purple-100 mb-8 max-w-2xl mx-auto">
                Contactez-nous dès aujourd'hui pour discuter de votre projet et obtenir un devis personnalisé.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact.index') }}" class="inline-block bg-white px-10 py-4 rounded-full text-lg font-bold hover:bg-gray-100 transition-all duration-300 shadow-xl hover:shadow-2xl hover:scale-105 uppercase tracking-wide" style="color: #9e10ab;">
                    Demander un devis
                </a>
                <a href="{{ route('portfolio.index') }}" class="service-cta-secondary inline-block bg-transparent border-2 border-white px-10 py-4 rounded-full text-lg font-bold transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 uppercase tracking-wide">
                    Voir nos réalisations
                </a>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    /* Assurer la visibilité du texte du bouton "Voir nos réalisations" */
    .service-cta-secondary {
        color: white !important;
    }
    
    .service-cta-secondary:hover {
        color: #9e10ab !important;
        background-color: white !important;
    }
</style>
@endpush

@push('scripts')
@include('partials.anime-scripts')
@endpush
@endsection

