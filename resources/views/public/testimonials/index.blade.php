@extends('layouts.app')

@section('title', 'Témoignages - ZEEEMAX')
@section('description', 'Découvrez ce que nos clients disent de notre expertise et accompagnement')

@section('content')
<!-- Hero Section -->
<section class="relative py-56 bg-gradient-to-br from-purple-900 via-purple-800 to-blue-900 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute inset-0" style="background-image: url('{{ asset('images/testimonials-bg.jpg') }}'); background-size: cover; background-position: center;"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <p class="text-purple-300 font-bold uppercase tracking-widest text-sm mb-4 animate-fade-in-up">Témoignages</p>
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-6 leading-tight title-gradient-glass" style="opacity: 0.95;">
                Ils sont satisfaits de nos services !
            </h1>
            <p class="text-xl md:text-2xl text-purple-100 max-w-3xl mx-auto leading-relaxed animate-fade-in-up animation-delay-400">
                Découvrez ce que nos clients disent de notre expertise
            </p>
        </div>
    </div>
</section>

<!-- Testimonials Grid -->
<section class="relative py-24 text-white overflow-hidden bg-cover bg-center bg-fixed" style="background-image: url('{{ asset('images/testimonials-bg.jpg') }}');">
    <div class="absolute inset-0 bg-black opacity-60"></div>
    @include('partials.anime-background')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        @if($testimonials->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-2xl border border-white/20 hover:bg-white/20 transition-all duration-300">
                    <!-- Avatar -->
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-white/30 mr-4">
                            <img src="{{ $testimonial->avatar_url ? (str_starts_with($testimonial->avatar_url, 'http') ? $testimonial->avatar_url : asset($testimonial->avatar_url)) : 'https://ui-avatars.com/api/?name=' . urlencode($testimonial->nom_client) . '&background=purple&color=fff&size=64' }}" 
                                 alt="{{ $testimonial->nom_client }}" 
                                 class="w-full h-full object-cover"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($testimonial->nom_client) }}&background=purple&color=fff&size=64'">
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">{{ $testimonial->nom_client }}</h3>
                            <p class="text-purple-200 text-sm">{{ $testimonial->profession }}</p>
                        </div>
                    </div>
                    
                    <!-- Note -->
                    @if($testimonial->note)
                    <div class="mb-4">
                        <div class="flex text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $testimonial->note ? 'text-yellow-400' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                        </div>
                    </div>
                    @endif
                    
                    <!-- Contenu -->
                    <p class="text-white leading-relaxed mb-4 italic">"{{ $testimonial->contenu }}"</p>
                    
                    <!-- Métrique -->
                    @if($testimonial->metrique)
                    <div class="pt-4 border-t border-white/20">
                        <p class="text-purple-200 font-semibold text-sm">{{ $testimonial->metrique }}</p>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-white text-lg">Aucun témoignage disponible pour le moment.</p>
            </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-5xl font-black mb-6 tracking-tight title-gradient-glass">
            Rejoignez nos clients satisfaits
        </h2>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
            Lancez votre projet avec ZEEEMAX et obtenez des résultats concrets
        </p>
        <a href="{{ route('contact.index') }}" class="inline-block bg-purple-600 text-white px-10 py-4 rounded-full text-lg font-bold hover:bg-purple-700 transition-all duration-300 shadow-xl hover:shadow-2xl hover:scale-105 uppercase tracking-wide">
            Commencer maintenant
        </a>
    </div>
</section>

@push('scripts')
@include('partials.anime-scripts')
@endpush
@endsection

