@extends('layouts.app')

@section('title', 'Newsletters - ZEEEMAX')
@section('description', 'Recevez nos meilleures ressources et actualités')

@section('content')
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold mb-10">Newsletters</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($articles as $a)
            <a href="{{ route('newsletter.show', $a->slug) }}" class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden group">
                @if($a->image_couverture)
                    <img src="{{ asset($a->image_couverture) }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" alt="{{ $a->titre }}">
                @endif
                <div class="p-5">
                    <h2 class="text-xl font-bold mb-2">{{ $a->titre }}</h2>
                    @if(!empty($a->categorie))
                    <span class="inline-block text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded mb-2">{{ $a->categorie }}</span>
                    @endif
                    @if($a->extrait)
                    <p class="text-gray-600 text-sm">{{ $a->extrait }}</p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
        <div class="mt-8">{{ $articles->links() }}</div>
    </div>
</section>
@endsection


