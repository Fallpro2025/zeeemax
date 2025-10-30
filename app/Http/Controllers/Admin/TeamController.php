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
    public function index(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        // Récupérer les paramètres de recherche et filtre
        $search = $request->get('search', '');
        $statut = $request->get('statut', 'all'); // 'all', 'actif', 'inactif'
        $sortBy = $request->get('sort_by', 'ordre'); // 'ordre', 'nom', 'poste', 'created_at', 'updated_at'
        $sortOrder = $request->get('sort_order', 'asc'); // 'asc', 'desc'
        
        // Construire la requête
        $query = Team::query();
        
        // Appliquer la recherche
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('poste', 'like', "%{$search}%")
                  ->orWhere('bio', 'like', "%{$search}%");
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
        
        $team = $query->get();
        
        return view('admin.team.index', compact('team', 'search', 'statut', 'sortBy', 'sortOrder'));
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
            'photo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'reseau_social' => 'nullable|string',
            'actif' => 'boolean',
            'ordre' => 'integer|min:0'
        ]);

        // Gérer l'upload de la photo
        $photoUrl = null;
        if ($request->hasFile('photo_file')) {
            $photo = $request->file('photo_file');
            $photoName = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('images/team'), $photoName);
            $photoUrl = 'images/team/' . $photoName;
        } else {
            // Photo par défaut
            $photoUrl = 'https://ui-avatars.com/api/?name=' . urlencode($validated['nom']) . '&background=blue&color=fff&size=128';
        }
        
        $validated['photo_url'] = $photoUrl;
        $validated['actif'] = $request->has('actif') ? 1 : 0;
        
        Team::create($validated);

        return redirect()->route('admin.team.index')
            ->with('success', 'Membre ajouté avec succès !');
    }

    /**
     * Afficher un membre spécifique
     */
    public function show($id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $team = Team::findOrFail($id);
        
        return view('admin.team.show', compact('team'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit($id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $team = Team::findOrFail($id);
        
        return view('admin.team.edit', compact('team'));
    }

    /**
     * Mettre à jour un membre
     */
    public function update(Request $request, $id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $team = Team::findOrFail($id);
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'reseau_social' => 'nullable|string',
            'actif' => 'boolean',
            'ordre' => 'nullable|integer|min:0'
        ]);

        // Gérer l'upload de la photo
        if ($request->hasFile('photo_file')) {
            // Supprimer l'ancienne photo si elle existe et n'est pas un URL externe
            if ($team->photo_url && !str_starts_with($team->photo_url, 'http') && file_exists(public_path($team->photo_url))) {
                unlink(public_path($team->photo_url));
            }
            
            // Uploader la nouvelle photo
            $photo = $request->file('photo_file');
            $photoName = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('images/team'), $photoName);
            $validated['photo_url'] = 'images/team/' . $photoName;
        }
        // Ne pas toucher photo_url si aucun nouveau fichier n'est uploadé

        // Exclure photo_file du tableau de mise à jour
        unset($validated['photo_file']);
        
        // Gérer les réseaux sociaux
        if (isset($validated['reseau_social']) && !empty(trim($validated['reseau_social']))) {
            // Si c'est une chaîne, la convertir en array
            $links = array_filter(array_map('trim', explode(',', $validated['reseau_social'])));
            // Le modèle gère le cast en array
            $validated['reseau_social'] = !empty($links) ? $links : null;
        } else {
            // Si vide ou non fourni, conserver les réseaux sociaux existants
            $validated['reseau_social'] = $team->reseau_social;
        }

        // Gérer bio nullable (préserver si vide)
        if (!isset($validated['bio']) || $validated['bio'] === '') {
            $validated['bio'] = $team->bio;
        }

        // Gérer actif
        $validated['actif'] = $request->has('actif') ? 1 : 0;
        
        // Gérer ordre (préserver si non fourni)
        if (!isset($validated['ordre']) || $validated['ordre'] === null) {
            $validated['ordre'] = $team->ordre ?? 0;
        }
        
        $team->update($validated);

        return redirect()->route('admin.team.index')
            ->with('success', 'Membre mis à jour avec succès !');
    }

    /**
     * Supprimer un membre
     */
    public function destroy($id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $team = Team::findOrFail($id);
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
