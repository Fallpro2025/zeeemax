<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
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
     * Afficher la liste de l'équipe
     */
    public function index()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $team = Team::orderBy('ordre')->get();
        return view('admin.team.index', compact('team'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.team.create');
    }

    /**
     * Enregistrer un nouveau membre
     */
    public function store(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo_url' => 'nullable|url',
            'reseau_social' => 'nullable|string',
            'actif' => 'boolean',
            'ordre' => 'integer|min:0'
        ]);

        $validated['actif'] = $request->has('actif') ? 1 : 0;
        
        Team::create($validated);

        return redirect()->route('admin.team.index')
            ->with('success', 'Membre ajouté avec succès !');
    }

    /**
     * Afficher un membre spécifique
     */
    public function show(Team $team)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.team.show', compact('team'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Team $team)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.team.edit', compact('team'));
    }

    /**
     * Mettre à jour un membre
     */
    public function update(Request $request, Team $team)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo_url' => 'nullable|url',
            'reseau_social' => 'nullable|string',
            'actif' => 'boolean',
            'ordre' => 'integer|min:0'
        ]);

        $validated['actif'] = $request->has('actif') ? 1 : 0;
        
        $team->update($validated);

        return redirect()->route('admin.team.index')
            ->with('success', 'Membre mis à jour avec succès !');
    }

    /**
     * Supprimer un membre
     */
    public function destroy(Team $team)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $team->delete();

        return redirect()->route('admin.team.index')
            ->with('success', 'Membre supprimé avec succès !');
    }

    /**
     * Activer/désactiver un membre (AJAX)
     */
    public function toggle(Team $team)
    {
        if ($redirect = $this->checkAdminAuth()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }
        
        $team->update(['actif' => !$team->actif]);
        
        return response()->json([
            'status' => 'success',
            'actif' => $team->actif
        ]);
    }
}
