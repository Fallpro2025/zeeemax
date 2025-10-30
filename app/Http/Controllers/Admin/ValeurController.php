<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Valeur;
use Illuminate\Http\Request;

class ValeurController extends Controller
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
     * Afficher la liste des valeurs
     */
    public function index(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $search = $request->get('search', '');
        $statut = $request->get('statut', 'all');
        $sortBy = $request->get('sort_by', 'ordre');
        $sortOrder = $request->get('sort_order', 'asc');
        
        $query = Valeur::query();
        
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        if ($statut === 'actif') {
            $query->where('actif', true);
        } elseif ($statut === 'inactif') {
            $query->where('actif', false);
        }
        
        $query->orderBy($sortBy, $sortOrder);
        $valeurs = $query->get();
        
        return view('admin.valeurs.index', compact('valeurs', 'search', 'statut', 'sortBy', 'sortOrder'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.valeurs.create');
    }

    /**
     * Enregistrer une nouvelle valeur
     */
    public function store(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'couleur' => 'required|string|in:purple,blue,purple-blue',
            'ordre' => 'nullable|integer|min:0',
            'actif' => 'boolean'
        ]);

        $validated['actif'] = $request->has('actif') ? 1 : 0;
        $validated['ordre'] = $validated['ordre'] ?? 0;

        Valeur::create($validated);

        return redirect()->route('admin.valeurs.index')
            ->with('success', 'Valeur créée avec succès !');
    }

    /**
     * Afficher une valeur spécifique
     */
    public function show($id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $valeur = Valeur::findOrFail($id);
        
        return view('admin.valeurs.show', compact('valeur'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit($id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $valeur = Valeur::findOrFail($id);
        
        return view('admin.valeurs.edit', compact('valeur'));
    }

    /**
     * Mettre à jour une valeur
     */
    public function update(Request $request, $id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $valeur = Valeur::findOrFail($id);
        
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'couleur' => 'required|string|in:purple,blue,purple-blue',
            'ordre' => 'nullable|integer|min:0',
            'actif' => 'boolean'
        ]);

        $validated['actif'] = $request->has('actif') ? 1 : 0;
        
        if (!isset($validated['ordre']) || $validated['ordre'] === null) {
            $validated['ordre'] = $valeur->ordre ?? 0;
        }
        
        $valeur->update($validated);

        return redirect()->route('admin.valeurs.index')
            ->with('success', 'Valeur mise à jour avec succès !');
    }

    /**
     * Supprimer une valeur
     */
    public function destroy($id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $valeur = Valeur::findOrFail($id);
        $valeur->delete();

        return redirect()->route('admin.valeurs.index')
            ->with('success', 'Valeur supprimée avec succès !');
    }

    /**
     * Toggle le statut actif/inactif
     */
    public function toggle($id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $valeur = Valeur::findOrFail($id);
        $valeur->actif = !$valeur->actif;
        $valeur->save();

        return response()->json([
            'success' => true,
            'actif' => $valeur->actif,
            'message' => $valeur->actif ? 'Valeur activée' : 'Valeur désactivée'
        ]);
    }
}

