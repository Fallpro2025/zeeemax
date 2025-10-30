@extends('layouts.app')

@section('title', 'Notre Équipe - ZEEEMAX')
@section('description', 'Rencontrez l\'équipe passionnée qui fait ZEEEMAX')

@section('content')
<!-- Hero Section -->
<section class="relative py-32 bg-gradient-to-br from-purple-900 via-purple-800 to-blue-900 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute inset-0" style="background-image: url('{{ asset('images/hero-bg.jpg') }}'); background-size: cover; background-position: center;"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight">
                Notre équipe
            </h1>
            <p class="text-xl md:text-2xl text-purple-100 max-w-3xl mx-auto leading-relaxed">
                Rencontrez les talents qui font ZEEEMAX
            </p>
        </div>
    </div>
</section>

<!-- Team Grid -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($team->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($team as $member)
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 text-center transform hover:-translate-y-2 min-h-[420px] flex flex-col max-w-sm mx-auto group">
                    <div class="w-48 h-48 rounded-xl mx-auto mb-6 overflow-hidden border-2 border-purple-100 shadow-md">
                        <img src="{{ $member->photo_url ? (str_starts_with($member->photo_url, 'http') ? $member->photo_url : asset($member->photo_url)) : 'https://ui-avatars.com/api/?name=' . urlencode($member->nom) . '&background=purple&color=fff&size=256' }}" 
                             alt="{{ $member->nom }}" 
                             class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-125">
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $member->nom }}</h3>
                    <p class="text-purple-600 font-semibold mb-4">{{ $member->poste }}</p>
                    @if($member->bio)
                        <p class="text-gray-600 leading-relaxed mb-4 flex-grow">{{ $member->bio }}</p>
                    @endif
                    @if($member->reseau_social && is_array($member->reseau_social))
                        <div class="flex justify-center gap-4 mt-4">
                            @foreach($member->reseau_social as $key => $url)
                                @if($url)
                                <a href="{{ $url }}" target="_blank" rel="noopener" class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center hover:bg-purple-600 hover:text-white transition-colors">
                                    @if($key === 'linkedin')
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                    @elseif($key === 'twitter')
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
                                    @else
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/></svg>
                                    @endif
                                </a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-gray-600 text-lg">Aucun membre d'équipe disponible pour le moment.</p>
            </div>
        @endif
    </div>
</section>
@endsection

