@extends('layouts.admin-sidebar')

@section('content')
<div class="p-6 max-w-xl">
    <h1 class="text-2xl font-bold mb-6">Nouvel abonné</h1>
    <form action="{{ route('admin.subscribers.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2" required>
            @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Prénom</label>
                <input type="text" name="prenom" value="{{ old('prenom') }}" class="w-full border rounded px-3 py-2">
                @error('prenom')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Nom</label>
                <input type="text" name="nom" value="{{ old('nom') }}" class="w-full border rounded px-3 py-2">
                @error('nom')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.subscribers.index') }}" class="px-4 py-2 border rounded">Annuler</a>
            <button class="px-4 py-2 bg-purple-600 text-white rounded">Enregistrer</button>
        </div>
    </form>
</div>
@endsection


