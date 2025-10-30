@extends('layouts.admin-sidebar')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Articles / Newsletters</h1>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.subscribers.index') }}" class="px-4 py-2 border rounded-lg">Voir abonnés</a>
            <a href="{{ route('admin.newsletters.create') }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg">Nouvelle newsletter</a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-500 text-white px-4 py-3 rounded">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Publié</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($posts as $post)
                <tr>
                    <td class="px-6 py-4">{{ $post->titre }}</td>
                    <td class="px-6 py-4">{{ $post->publie ? 'Oui' : 'Non' }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <form action="{{ route('admin.newsletters.send', $post) }}" method="POST" class="inline js-confirm" title="Envoyer">
                            @csrf
                            <button type="button" class="p-2 rounded hover:bg-purple-50 text-purple-600 js-confirm-btn"
                                    data-confirm-message="Voulez-vous envoyer la newsletter « {{ $post->titre }} » à tous les abonnés actifs ?"
                                    data-confirm-title="Confirmer l'envoi"
                                    data-confirm-type="info"
                                    data-confirm-confirm="Envoyer maintenant"
                                    data-confirm-cancel="Annuler">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8m-9 4l-9-4m18 0v8a2 2 0 01-2 2H6a2 2 0 01-2-2V8" />
                                </svg>
                                <span class="sr-only">Envoyer</span>
                            </button>
                        </form>
                        <a href="{{ route('admin.newsletters.edit', $post) }}" class="p-2 rounded hover:bg-blue-50 text-blue-600 inline-flex" title="Éditer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M4 20h4l10.243-10.243a2 2 0 000-2.828l-1.172-1.172a2 2 0 00-2.828 0L4 16v4z" />
                            </svg>
                            <span class="sr-only">Éditer</span>
                        </a>
                        <form action="{{ route('admin.newsletters.destroy', $post) }}" method="POST" class="inline js-confirm" title="Supprimer">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="p-2 rounded hover:bg-red-50 text-red-600 js-confirm-btn"
                                    data-confirm-message="Supprimer définitivement cette newsletter ?"
                                    data-confirm-title="Suppression"
                                    data-confirm-type="danger"
                                    data-confirm-confirm="Supprimer"
                                    data-confirm-cancel="Annuler">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <span class="sr-only">Supprimer</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $posts->links() }}</div>
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
@endsection
