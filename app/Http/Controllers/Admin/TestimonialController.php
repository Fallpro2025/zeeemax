<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
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
     * Afficher la liste des témoignages
     */
    public function index(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        // Récupérer les paramètres de recherche et filtre
        $search = $request->get('search', '');
        $statut = $request->get('statut', 'all'); // 'all', 'actif', 'inactif', 'featured'
        $sortBy = $request->get('sort_by', 'ordre'); // 'ordre', 'nom_client', 'note', 'created_at', 'updated_at'
        $sortOrder = $request->get('sort_order', 'asc'); // 'asc', 'desc'
        
        // Construire la requête
        $query = Testimonial::query();
        
        // Appliquer la recherche
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('nom_client', 'like', "%{$search}%")
                  ->orWhere('profession', 'like', "%{$search}%")
                  ->orWhere('contenu', 'like', "%{$search}%");
            });
        }
        
        // Appliquer le filtre de statut
        if ($statut === 'actif') {
            $query->where('actif', true);
        } elseif ($statut === 'inactif') {
            $query->where('actif', false);
        } elseif ($statut === 'featured') {
            $query->where('featured', true);
        }
        
        // Appliquer le tri
        $query->orderBy($sortBy, $sortOrder);
        
        $testimonials = $query->get();
        
        return view('admin.testimonials.index', compact('testimonials', 'search', 'statut', 'sortBy', 'sortOrder'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.testimonials.create');
    }

    /**
     * Enregistrer un nouveau témoignage
     */
    public function store(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $validated = $request->validate([
            'nom_client' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'contenu' => 'required|string',
            'metrique' => 'nullable|string|max:255',
            'avatar_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'note' => 'integer|min:1|max:5',
            'featured' => 'boolean',
            'actif' => 'boolean',
            'ordre' => 'integer|min:0'
        ]);

        // Gérer l'upload de l'avatar
        $avatarUrl = null;
        if ($request->hasFile('avatar_file')) {
            $avatar = $request->file('avatar_file');
            $avatarName = time() . '_' . uniqid() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('images/avatars'), $avatarName);
            $avatarUrl = 'images/avatars/' . $avatarName;
        } else {
            // Avatar par défaut si aucun fichier n'est uploadé
            $avatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($validated['nom_client']) . '&background=blue&color=fff&size=128';
        }
        
        $validated['avatar_url'] = $avatarUrl;

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Témoignage ajouté avec succès !');
    }

    /**
     * Afficher un témoignage spécifique
     */
    public function show($id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $testimonial = Testimonial::findOrFail($id);
        
        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit($id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $testimonial = Testimonial::findOrFail($id);
        
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Mettre à jour un témoignage
     */
    public function update(Request $request, $id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $testimonial = Testimonial::findOrFail($id);
        
        $validated = $request->validate([
            'nom_client' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'contenu' => 'required|string',
            'metrique' => 'nullable|string|max:255',
            'avatar_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'note' => 'required|integer|min:1|max:5',
            'featured' => 'boolean',
            'actif' => 'boolean',
            'ordre' => 'nullable|integer|min:0'
        ]);

        // Gérer l'upload de l'avatar
        if ($request->hasFile('avatar_file')) {
            // Supprimer l'ancien avatar s'il existe et n'est pas un URL externe
            if ($testimonial->avatar_url && !str_starts_with($testimonial->avatar_url, 'http') && file_exists(public_path($testimonial->avatar_url))) {
                unlink(public_path($testimonial->avatar_url));
            }
            
            // Uploader le nouveau avatar
            $avatar = $request->file('avatar_file');
            $avatarName = time() . '_' . uniqid() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('images/avatars'), $avatarName);
            $validated['avatar_url'] = 'images/avatars/' . $avatarName;
        }
        // Ne pas toucher avatar_url si aucun nouveau fichier n'est uploadé

        // Exclure avatar_file du tableau de mise à jour
        unset($validated['avatar_file']);
        
        // Gérer metrique nullable (préserver si vide ou null)
        if (!isset($validated['metrique']) || $validated['metrique'] === '' || $validated['metrique'] === null) {
            $validated['metrique'] = $testimonial->metrique;
        }

        // Gérer featured et actif
        $validated['featured'] = $request->has('featured') ? 1 : 0;
        $validated['actif'] = $request->has('actif') ? 1 : 0;
        
        // Gérer ordre (préserver si non fourni)
        if (!isset($validated['ordre']) || $validated['ordre'] === null) {
            $validated['ordre'] = $testimonial->ordre ?? 0;
        }
        
        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Témoignage mis à jour avec succès !');
    }

    /**
     * Supprimer un témoignage
     */
    public function destroy($id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Témoignage supprimé avec succès !');
    }

    /**
     * Toggle featured status (AJAX)
     */
    public function toggle(Testimonial $testimonial)
    {
        if ($redirect = $this->checkAdminAuth()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }
        
        $testimonial->update(['featured' => !$testimonial->featured]);
        
        return response()->json([
            'status' => 'success',
            'featured' => $testimonial->featured
        ]);
    }
}
