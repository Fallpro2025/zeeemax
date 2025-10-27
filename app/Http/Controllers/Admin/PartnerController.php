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
    public function index()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $partners = Partner::orderBy('ordre')->get();
        return view('admin.partners.index', compact('partners'));
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
            'logo_url' => 'nullable|url',
            'site_web' => 'nullable|url',
            'actif' => 'boolean',
            'ordre' => 'integer|min:0'
        ]);

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
            'logo_url' => 'nullable|url',
            'site_web' => 'nullable|url',
            'actif' => 'boolean',
            'ordre' => 'integer|min:0'
        ]);

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
