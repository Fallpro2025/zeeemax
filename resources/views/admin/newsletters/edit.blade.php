@extends('layouts.admin-sidebar')

@section('content')
<div class="p-6 max-w-4xl">
    <h1 class="text-2xl font-bold mb-6">Éditer l'article</h1>
    <form action="{{ route('admin.newsletters.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium mb-1">Titre</label>
            <input type="text" name="titre" value="{{ old('titre', $post->titre) }}" class="w-full border rounded px-3 py-2" required>
            @error('titre')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Slug (optionnel)</label>
            <input type="text" name="slug" value="{{ old('slug', $post->slug) }}" class="w-full border rounded px-3 py-2">
            @error('slug')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Extrait (optionnel)</label>
            <textarea name="extrait" class="w-full border rounded px-3 py-2" rows="3">{{ old('extrait', $post->extrait) }}</textarea>
            @error('extrait')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Catégorie (optionnel)</label>
            <input type="text" name="categorie" value="{{ old('categorie', $post->categorie) }}" class="w-full border rounded px-3 py-2" placeholder="Actualités, Conseils, Annonces...">
            @error('categorie')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Contenu</label>
            <textarea name="contenu" class="w-full border rounded px-3 py-2" rows="10" required>{{ old('contenu', $post->contenu) }}</textarea>
            @error('contenu')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Image de couverture</label>
            <input type="file" name="image_couverture" accept="image/*" class="w-full">
            @if($post->image_couverture)
                <img src="{{ asset($post->image_couverture) }}" alt="Couverture" class="h-24 mt-2 object-contain">
            @endif
            @error('image_couverture')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex items-center space-x-4">
            <label class="inline-flex items-center space-x-2">
                <input type="checkbox" name="publie" value="1" class="border rounded" {{ old('publie', $post->publie) ? 'checked' : '' }}>
                <span>Publier</span>
            </label>
            <div>
                <label class="block text-sm font-medium mb-1">Date de publication</label>
                <input type="datetime-local" name="publie_le" value="{{ old('publie_le', optional($post->publie_le)->format('Y-m-d\TH:i')) }}" class="border rounded px-3 py-2">
            </div>
        </div>
    <div class="flex justify-end space-x-3">
        <form action="{{ route('admin.newsletters.send', $post) }}" method="POST" class="inline js-confirm">
            @csrf
            <button type="button" class="px-4 py-2 border rounded text-purple-700 border-purple-300 hover:bg-purple-50 js-confirm-btn"
                    data-confirm-message="Voulez-vous envoyer la newsletter « {{ $post->titre }} » à tous les abonnés actifs ?"
                    data-confirm-title="Confirmer l'envoi"
                    data-confirm-type="info"
                    data-confirm-confirm="Envoyer maintenant"
                    data-confirm-cancel="Annuler">Envoyer par email</button>
        </form>
            <a href="{{ route('admin.newsletters.index') }}" class="px-4 py-2 border rounded">Annuler</a>
            <button class="px-4 py-2 bg-purple-600 text-white rounded">Mettre à jour</button>
        </div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('form.js-confirm .js-confirm-btn').forEach(function(btn) {
        btn.addEventListener('click', async function(e) {
            e.preventDefault();
            const form = btn.closest('form');
            const ok = await window.adminConfirm.confirm(
                btn.dataset.confirmMessage || 'Confirmer cette action ?',
                {
                    title: btn.dataset.confirmTitle || 'Confirmation',
                    confirmText: btn.dataset.confirmConfirm || 'Confirmer',
                    cancelText: btn.dataset.confirmCancel || 'Annuler',
                    type: btn.dataset.confirmType || 'warning',
                    confirmClass: btn.dataset.confirmType === 'danger' ? 'bg-red-600 hover:bg-red-700' : 'bg-blue-600 hover:bg-blue-700'
                }
            );
            if (ok) {
                form.submit();
            }
        });
    });
});
</script>
@endpush
    </form>
    </div>
@endsection
