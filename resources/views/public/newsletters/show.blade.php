@extends('layouts.app')

@section('title', $article->titre.' - Newsletter ZEEEMAX')
@section('description', $article->extrait ?? Str::limit(strip_tags($article->contenu), 150))

@section('content')
<section class="py-16 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold mb-6">{{ $article->titre }}</h1>
        @if(!empty($article->categorie))
            <div class="mb-4">
                <span class="inline-block text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded">{{ $article->categorie }}</span>
            </div>
        @endif
        @if($article->image_couverture)
            <img src="{{ asset($article->image_couverture) }}" class="w-full rounded-2xl mb-8 object-cover" alt="{{ $article->titre }}">
        @endif
        <article class="prose max-w-none">
            {!! nl2br(e($article->contenu)) !!}
        </article>
    </div>
</section>
@endsection


