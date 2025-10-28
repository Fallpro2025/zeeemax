<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
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
     * Afficher la liste des partenaires
     */
    public function index(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        // Récupérer les paramètres de recherche et filtre
        $search = $request->get('search', '');
        $statut = $request->get('statut', 'all'); // 'all', 'actif', 'inactif'
        $sortBy = $request->get('sort_by', 'ordre'); // 'ordre', 'nom', 'created_at', 'updated_at'
        $sortOrder = $request->get('sort_order', 'asc'); // 'asc', 'desc'
        
        // Construire la requête
        $query = Partner::query();
        
        // Appliquer la recherche
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
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
        
        $partners = $query->get();
        
        return view('admin.partners.index', compact('partners', 'search', 'statut', 'sortBy', 'sortOrder'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.partners.create');
    }

    /**
     * Enregistrer un nouveau partenaire
     */
    public function store(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'site_web' => 'nullable|url',
            'actif' => 'boolean',
            'ordre' => 'integer|min:0'
        ]);

        // Gérer l'upload du logo
        $logoUrl = null;
        if ($request->hasFile('logo_file')) {
            $logo = $request->file('logo_file');
            $logoName = time() . '_' . uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('images/partners'), $logoName);
            $logoUrl = 'images/partners/' . $logoName;
        } else {
            // Logo par défaut
            $logoUrl = 'https://ui-avatars.com/api/?name=' . urlencode($validated['nom']) . '&background=blue&color=fff&size=128';
        }
        
        $validated['logo_url'] = $logoUrl;
        $validated['actif'] = $request->has('actif') ? 1 : 0;
        
        Partner::create($validated);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partenaire créé avec succès !');
    }

    /**
     * Afficher un partenaire spécifique
     */
    public function show(Partner $partner)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.partners.show', compact('partner'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Partner $partner)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.partners.edit', compact('partner'));
    }

    /**
     * Mettre à jour un partenaire
     */
    public function update(Request $request, Partner $partner)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'site_web' => 'nullable|url',
            'actif' => 'boolean',
            'ordre' => 'integer|min:0'
        ]);

        // Gérer l'upload du logo
        if ($request->hasFile('logo_file')) {
            // Supprimer l'ancien logo si il existe et n'est pas un URL externe
            if ($partner->logo_url && !str_starts_with($partner->logo_url, 'http') && file_exists(public_path($partner->logo_url))) {
                unlink(public_path($partner->logo_url));
            }
            
            // Uploader le nouveau logo
            $logo = $request->file('logo_file');
            $logoName = time() . '_' . uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('images/partners'), $logoName);
            $validated['logo_url'] = 'images/partners/' . $logoName;
        }

        $validated['actif'] = $request->has('actif') ? 1 : 0;
        
        $partner->update($validated);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partenaire mis à jour avec succès !');
    }

    /**
     * Supprimer un partenaire
     */
    public function destroy(Partner $partner)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partenaire supprimé avec succès !');
    }

    /**
     * Activer/désactiver un partenaire (AJAX)
     */
    public function toggle(Partner $partner)
    {
        if ($redirect = $this->checkAdminAuth()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }
        
        $partner->update(['actif' => !$partner->actif]);
        
        return response()->json([
            'status' => 'success',
            'actif' => $partner->actif
        ]);
    }
}
