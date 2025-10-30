<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apropos;
use Illuminate\Http\Request;

class AproposController extends Controller
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
     * Afficher la liste des sections "À propos"
     */
    public function index()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $apropos = Apropos::orderBy('created_at', 'desc')->get();
        return view('admin.apropos.index', compact('apropos'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.apropos.create');
    }

    /**
     * Enregistrer une nouvelle section "À propos"
     */
    public function store(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        // Gérer l'upload de l'image
        $imageUrl = null;
        if ($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/apropos'), $imageName);
            $imageUrl = 'images/apropos/' . $imageName;
        }
        
        $validated['image_url'] = $imageUrl;

        Apropos::create($validated);

        return redirect()->route('admin.apropos.index')
            ->with('success', 'Section "À propos" créée avec succès !');
    }

    /**
     * Afficher une section "À propos" spécifique
     */
    public function show($id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $apropos = Apropos::findOrFail($id);
        
        return view('admin.apropos.show', compact('apropos'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit($id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $apropos = Apropos::findOrFail($id);
        
        return view('admin.apropos.edit', compact('apropos'));
    }

    /**
     * Mettre à jour une section "À propos"
     */
    public function update(Request $request, $id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $apropos = Apropos::findOrFail($id);
        
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        // Gérer l'upload de l'image
        if ($request->hasFile('image_file')) {
            // Supprimer l'ancienne image si elle existe et n'est pas un URL externe
            if ($apropos->image_url && !str_starts_with($apropos->image_url, 'http') && file_exists(public_path($apropos->image_url))) {
                unlink(public_path($apropos->image_url));
            }
            
            // Uploader la nouvelle image
            $image = $request->file('image_file');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/apropos'), $imageName);
            $validated['image_url'] = 'images/apropos/' . $imageName;
        } else {
            // Conserver l'ancienne image si aucun nouveau fichier n'est uploadé
            unset($validated['image_file']);
        }

        // Exclure image_file du tableau de mise à jour
        unset($validated['image_file']);
        
        $apropos->update($validated);

        return redirect()->route('admin.apropos.index')
            ->with('success', 'Section "À propos" mise à jour avec succès !');
    }

    /**
     * Supprimer une section "À propos"
     */
    public function destroy($id)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $apropos = Apropos::findOrFail($id);
        
        // Supprimer l'image si elle existe
        if ($apropos->image_url && !str_starts_with($apropos->image_url, 'http') && file_exists(public_path($apropos->image_url))) {
            unlink(public_path($apropos->image_url));
        }
        
        $apropos->delete();

        return redirect()->route('admin.apropos.index')
            ->with('success', 'Section "À propos" supprimée avec succès !');
    }
}

