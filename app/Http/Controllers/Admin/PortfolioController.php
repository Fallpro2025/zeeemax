<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PortfolioController extends Controller
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
     * Afficher la liste des projets portfolio
     */
    public function index()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $portfolioItems = PortfolioItem::orderBy('ordre')->get();
        return view('admin.portfolio.index', compact('portfolioItems'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.portfolio.create');
    }

    /**
     * Enregistrer un nouveau projet
     */
    public function store(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:portfolio_items,slug',
            'categorie' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|url',
            'technologies' => 'nullable|array',
            'lien_demo' => 'nullable|url',
            'lien_github' => 'nullable|url',
            'featured' => 'boolean',
            'actif' => 'boolean',
            'ordre' => 'integer|min:0'
        ]);

        PortfolioItem::create($validated);

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Projet ajouté avec succès !');
    }

    /**
     * Afficher un projet spécifique
     */
    public function show(PortfolioItem $portfolioItem)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.portfolio.show', compact('portfolioItem'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(PortfolioItem $portfolioItem)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.portfolio.edit', compact('portfolioItem'));
    }

    /**
     * Mettre à jour un projet
     */
    public function update(Request $request, PortfolioItem $portfolioItem)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('portfolio_items', 'slug')->ignore($portfolioItem->id)
            ],
            'categorie' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|url',
            'technologies' => 'nullable|array',
            'lien_demo' => 'nullable|url',
            'lien_github' => 'nullable|url',
            'featured' => 'boolean',
            'actif' => 'boolean',
            'ordre' => 'integer|min:0'
        ]);

        $portfolioItem->update($validated);

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Projet mis à jour avec succès !');
    }

    /**
     * Supprimer un projet
     */
    public function destroy(PortfolioItem $portfolioItem)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $portfolioItem->delete();

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Projet supprimé avec succès !');
    }

    /**
     * Toggle featured status (AJAX)
     */
    public function toggle(PortfolioItem $portfolioItem)
    {
        if ($redirect = $this->checkAdminAuth()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }
        
        $portfolioItem->update(['featured' => !$portfolioItem->featured]);
        
        return response()->json([
            'status' => 'success',
            'featured' => $portfolioItem->featured
        ]);
    }
}
