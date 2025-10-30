@extends('layouts.admin-sidebar')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Abonnés</h1>
        <a href="{{ route('admin.subscribers.create') }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg">Nouvel abonné</a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-500 text-white px-4 py-3 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 bg-red-500 text-white px-4 py-3 rounded">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prénom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actif</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($subs as $s)
                <tr>
                    <td class="px-6 py-4">{{ $s->email }}</td>
                    <td class="px-6 py-4">{{ $s->nom }}</td>
                    <td class="px-6 py-4">{{ $s->prenom }}</td>
                    <td class="px-6 py-4">{{ $s->actif ? 'Oui' : 'Non' }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <form action="{{ route('admin.subscribers.toggle', $s) }}" method="POST" class="inline js-confirm" data-confirm-message="Basculer le statut de cet abonné ?" data-confirm-title="Changer le statut" data-confirm-type="info" data-confirm-confirm="Confirmer" data-confirm-cancel="Annuler">
                            @csrf
                            <button class="p-2 rounded hover:bg-blue-50 text-blue-600" title="Activer/Désactiver">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                <span class="sr-only">Toggle</span>
                            </button>
                        </form>
                        <form action="{{ route('admin.subscribers.destroy', $s) }}" method="POST" class="inline js-confirm" data-confirm-message="Supprimer cet abonné ?" data-confirm-title="Suppression" data-confirm-type="danger" data-confirm-confirm="Supprimer" data-confirm-cancel="Annuler">
                            @csrf
                            @method('DELETE')
                            <button class="p-2 rounded hover:bg-red-50 text-red-600" title="Supprimer">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                <span class="sr-only">Supprimer</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $subs->links() }}</div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('form.js-confirm').forEach(function(form) {
        form.addEventListener('submit', async function(e) {
            if (form.dataset.bound === '1') return;
            e.preventDefault();
            const ok = await window.adminConfirm.confirm(
                form.dataset.confirmMessage || 'Confirmer ?',
                {
                    title: form.dataset.confirmTitle || 'Confirmation',
                    confirmText: form.dataset.confirmConfirm || 'Confirmer',
                    cancelText: form.dataset.confirmCancel || 'Annuler',
                    type: form.dataset.confirmType || 'warning',
                    confirmClass: form.dataset.confirmType === 'danger' ? 'bg-red-600 hover:bg-red-700' : 'bg-blue-600 hover:bg-blue-700'
                }
            );
            if (ok) { form.dataset.bound = '1'; form.submit(); }
        }, { once: true });
    });
});
</script>
@endpush
@endsection


