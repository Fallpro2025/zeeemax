@extends('layouts.admin-sidebar')

@section('content')
<div class="p-6 max-w-4xl">
    <h1 class="text-2xl font-bold mb-6">Nouvel article</h1>
    <form action="{{ route('admin.newsletters.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Titre</label>
            <input type="text" name="titre" value="{{ old('titre') }}" class="w-full border rounded px-3 py-2" required>
            @error('titre')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Slug (optionnel)</label>
            <input type="text" name="slug" value="{{ old('slug') }}" class="w-full border rounded px-3 py-2">
            @error('slug')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Extrait (optionnel)</label>
            <textarea name="extrait" class="w-full border rounded px-3 py-2" rows="3">{{ old('extrait') }}</textarea>
            @error('extrait')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Catégorie (optionnel)</label>
            <input type="text" name="categorie" value="{{ old('categorie') }}" class="w-full border rounded px-3 py-2" placeholder="Actualités, Conseils, Annonces...">
            @error('categorie')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Contenu</label>
            <textarea name="contenu" class="w-full border rounded px-3 py-2" rows="10" required>{{ old('contenu') }}</textarea>
            @error('contenu')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Image de couverture</label>
            <input type="file" name="image_couverture" accept="image/*" class="w-full">
            @error('image_couverture')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex items-center space-x-4">
            <label class="inline-flex items-center space-x-2">
                <input type="checkbox" name="publie" value="1" class="border rounded" {{ old('publie') ? 'checked' : '' }}>
                <span>Publier</span>
            </label>
            <div>
                <label class="block text-sm font-medium mb-1">Date de publication</label>
                <input type="datetime-local" name="publie_le" value="{{ old('publie_le') }}" class="border rounded px-3 py-2">
            </div>
        </div>
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.newsletters.index') }}" class="px-4 py-2 border rounded">Annuler</a>
            <button class="px-4 py-2 bg-purple-600 text-white rounded">Enregistrer</button>
        </div>
    </form>
</div>
@endsection
