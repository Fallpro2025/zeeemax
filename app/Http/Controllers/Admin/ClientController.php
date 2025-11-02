<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Vérifier l'authentification admin
     */
    private function checkAdminAuth()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        return null;
    }

    /**
     * Afficher la liste des clients
     */
    public function index(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        // Récupérer les paramètres de recherche et filtre
        $search = $request->get('search', '');
        $statut = $request->get('statut', 'all'); // 'all', 'actif', 'inactif'
        $sortBy = $request->get('sort_by', 'ordre'); // 'ordre', 'nom', 'type', 'created_at', 'updated_at'
        $sortOrder = $request->get('sort_order', 'asc'); // 'asc', 'desc'
        
        // Construire la requête
        $query = Client::query();
        
        // Appliquer la recherche
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%");
            });
        }
        
        // Appliquer le filtre de statut
        if ($statut === 'actif') {
            $query->where('actif', true);
        } elseif ($statut === 'inactif') {
            $query->where('actif', false);
        }
        
        // Appliquer le tri
        $query->orderBy($sortBy, $sortOrder);
        
        $clients = $query->get();
        
        return view('admin.clients.index', compact('clients', 'search', 'statut', 'sortBy', 'sortOrder'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.clients.create');
    }

    /**
     * Enregistrer un nouveau client
     */
    public function store(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'logo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'logo_url' => 'nullable|url',
            'actif' => 'boolean',
            'ordre' => 'integer|min:0'
        ]);

        // Gérer l'upload du logo si fourni
        $logoUrl = null;
        if ($request->hasFile('logo_file')) {
            $file = $request->file('logo_file');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('clients', $filename, 'public');
            $logoUrl = Storage::url($path);
        } elseif ($request->filled('logo_url')) {
            $logoUrl = $validated['logo_url'];
        }

        Client::create([
            'nom' => $validated['nom'],
            'type' => $validated['type'] ?? null,
            'logo_url' => $logoUrl,
            'actif' => $validated['actif'] ?? true,
            'ordre' => $validated['ordre'] ?? 0
        ]);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client créé avec succès !');
    }

    /**
     * Afficher un client spécifique
     */
    public function show(Client $client)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Client $client)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Mettre à jour un client
     */
    public function update(Request $request, Client $client)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'logo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'logo_url' => 'nullable|url',
            'actif' => 'boolean',
            'ordre' => 'integer|min:0'
        ]);

        // Gérer l'upload du logo si fourni
        if ($request->hasFile('logo_file')) {
            // Supprimer l'ancien logo s'il existe
            if ($client->logo_url && str_contains($client->logo_url, '/storage/clients/')) {
                $oldPath = str_replace('/storage/', '', $client->logo_url);
                Storage::disk('public')->delete($oldPath);
            }
            
            $file = $request->file('logo_file');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('clients', $filename, 'public');
            $validated['logo_url'] = Storage::url($path);
        } elseif ($request->filled('logo_url')) {
            $validated['logo_url'] = $validated['logo_url'];
        } else {
            // Garder l'ancien logo si aucun nouveau n'est fourni
            unset($validated['logo_url']);
        }

        $client->update($validated);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client mis à jour avec succès !');
    }

    /**
     * Supprimer un client
     */
    public function destroy(Client $client)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        // Supprimer le logo s'il existe
        if ($client->logo_url && str_contains($client->logo_url, '/storage/clients/')) {
            $oldPath = str_replace('/storage/', '', $client->logo_url);
            Storage::disk('public')->delete($oldPath);
        }
        
        $client->delete();

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client supprimé avec succès !');
    }

    /**
     * Activer/désactiver un client (AJAX)
     */
    public function toggle(Client $client)
    {
        if ($redirect = $this->checkAdminAuth()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }
        
        $client->update(['actif' => !$client->actif]);
        
        return response()->json([
            'status' => 'success',
            'actif' => $client->actif
        ]);
    }
}
