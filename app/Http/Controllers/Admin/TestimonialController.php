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
    public function index()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $testimonials = Testimonial::orderBy('ordre')->get();
        return view('admin.testimonials.index', compact('testimonials'));
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
    public function show(Testimonial $testimonial)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Testimonial $testimonial)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Mettre à jour un témoignage
     */
    public function update(Request $request, Testimonial $testimonial)
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

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Témoignage mis à jour avec succès !');
    }

    /**
     * Supprimer un témoignage
     */
    public function destroy(Testimonial $testimonial)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
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
