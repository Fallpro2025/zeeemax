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
    public function index(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        // Récupérer les paramètres de recherche et filtre
        $search = $request->get('search', '');
        $categorie = $request->get('categorie', 'all');
        $statut = $request->get('statut', 'all'); // 'all', 'actif', 'inactif'
        $sortBy = $request->get('sort_by', 'ordre'); // 'ordre', 'titre', 'categorie', 'created_at', 'updated_at'
        $sortOrder = $request->get('sort_order', 'asc'); // 'asc', 'desc'
        
        // Construire la requête
        $query = PortfolioItem::query();
        
        // Appliquer la recherche
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('categorie', 'like', "%{$search}%");
            });
        }
        
        // Appliquer le filtre de catégorie
        if ($categorie !== 'all') {
            $query->where('categorie', $categorie);
        }
        
        // Appliquer le filtre de statut
        if ($statut === 'actif') {
            $query->where('actif', true);
        } elseif ($statut === 'inactif') {
            $query->where('actif', false);
        }
        
        // Appliquer le tri
        $query->orderBy($sortBy, $sortOrder);
        
        $portfolioItems = $query->get();
        
        // Récupérer toutes les catégories pour le filtre
        $categories = PortfolioItem::distinct()->pluck('categorie')->filter()->sort()->values();
        
        return view('admin.portfolio.index', compact('portfolioItems', 'search', 'categorie', 'statut', 'sortBy', 'sortOrder', 'categories'));
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
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'technologies' => 'nullable|string',
            'lien_demo' => 'nullable|url',
            'lien_github' => 'nullable|url',
            'featured' => 'boolean',
            'actif' => 'boolean',
            'ordre' => 'integer|min:0'
        ]);

        // Convertir les technologies en array si elles sont une chaîne
        if (isset($validated['technologies']) && is_string($validated['technologies'])) {
            $validated['technologies'] = array_filter(
                array_map('trim', explode(',', $validated['technologies']))
            );
        }
        
        // Gérer l'upload de l'image
        $imageUrl = null;
        if ($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/portfolio'), $imageName);
            $imageUrl = 'images/portfolio/' . $imageName;
        } else {
            // Image par défaut si aucune image n'est uploadée
            $imageUrl = 'https://via.placeholder.com/800x600/E5E7EB/9CA3AF?text=Portfolio+Image';
        }
        
        $validated['image_url'] = $imageUrl;
        
        PortfolioItem::create($validated);

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Projet ajouté avec succès !');
    }

    /**
     * Afficher un projet spécifique
     */
    public function show(PortfolioItem $portfolio)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.portfolio.show', compact('portfolio'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(PortfolioItem $portfolio)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.portfolio.edit', compact('portfolio'));
    }

    /**
     * Mettre à jour un projet
     */
    public function update(Request $request, PortfolioItem $portfolio)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('portfolio_items', 'slug')->ignore($portfolio->id)
            ],
            'categorie' => 'required|string|max:255',
            'description' => 'required|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'technologies' => 'nullable|string',
            'lien_demo' => 'nullable|url',
            'lien_github' => 'nullable|url',
            'featured' => 'boolean',
            'actif' => 'boolean',
            'ordre' => 'integer|min:0'
        ]);

        // Convertir les technologies en array si elles sont une chaîne
        if (isset($validated['technologies']) && is_string($validated['technologies'])) {
            $validated['technologies'] = array_filter(
                array_map('trim', explode(',', $validated['technologies']))
            );
        }
        
        // Gérer l'upload de l'image
        if ($request->hasFile('image_file')) {
            // Supprimer l'ancienne image si elle n'est pas une URL externe
            if ($portfolio->image_url && !str_starts_with($portfolio->image_url, 'http')) {
                $oldImagePath = public_path($portfolio->image_url);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            $image = $request->file('image_file');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/portfolio'), $imageName);
            $validated['image_url'] = 'images/portfolio/' . $imageName;
        }

        $portfolio->update($validated);

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Projet mis à jour avec succès !');
    }

    /**
     * Supprimer un projet
     */
    public function destroy(PortfolioItem $portfolio)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $portfolio->delete();

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Projet supprimé avec succès !');
    }

    /**
     * Toggle featured status (AJAX)
     */
    public function toggle(PortfolioItem $portfolio)
    {
        if ($redirect = $this->checkAdminAuth()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }
        
        $portfolio->update(['featured' => !$portfolio->featured]);
        
        return response()->json([
            'status' => 'success',
            'featured' => $portfolio->featured
        ]);
    }
}
