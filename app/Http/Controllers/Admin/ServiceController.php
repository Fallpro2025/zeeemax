<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
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
     * Afficher la liste des services
     */
    public function index(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        // Récupérer les paramètres de recherche et filtre
        $search = $request->get('search', '');
        $statut = $request->get('statut', 'all'); // 'all', 'actif', 'inactif'
        $sortBy = $request->get('sort_by', 'ordre'); // 'ordre', 'titre', 'created_at', 'updated_at'
        $sortOrder = $request->get('sort_order', 'asc'); // 'asc', 'desc'
        
        // Construire la requête
        $query = Service::query();
        
        // Appliquer la recherche
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
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
        
        $services = $query->get();
        
        return view('admin.services.index', compact('services', 'search', 'statut', 'sortBy', 'sortOrder'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.services.create');
    }

    /**
     * Enregistrer un nouveau service
     */
    public function store(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug',
            'description' => 'required|string',
            'icone_svg' => 'nullable|string',
            'actif' => 'boolean',
            'ordre' => 'integer|min:0'
        ]);

        // Si pas de slug fourni, il sera généré automatiquement par le modèle
        // Nettoyer les espaces autour de l'icône SVG et décoder les entités HTML
        if (isset($validated['icone_svg'])) {
            $icone = trim($validated['icone_svg']);
            // Décoder les entités HTML si elles sont encodées
            $decoded = html_entity_decode($icone, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $validated['icone_svg'] = $decoded;
        }
        
        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service créé avec succès !');
    }

    /**
     * Afficher un service spécifique
     */
    public function show(Service $service)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.services.show', compact('service'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Service $service)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Mettre à jour un service
     */
    public function update(Request $request, Service $service)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('services', 'slug')->ignore($service->id)
            ],
            'description' => 'required|string',
            'icone_svg' => 'nullable|string',
            'actif' => 'boolean',
            'ordre' => 'integer|min:0'
        ]);

        // Nettoyer les espaces autour de l'icône SVG et décoder les entités HTML
        if (isset($validated['icone_svg'])) {
            $icone = trim($validated['icone_svg']);
            // Décoder les entités HTML si elles sont encodées
            $decoded = html_entity_decode($icone, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $validated['icone_svg'] = $decoded;
        }
        
        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service mis à jour avec succès !');
    }

    /**
     * Supprimer un service
     */
    public function destroy(Service $service)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service supprimé avec succès !');
    }

    /**
     * Activer/désactiver un service (AJAX)
     */
    public function toggle(Service $service)
    {
        if ($redirect = $this->checkAdminAuth()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }
        
        $service->update(['actif' => !$service->actif]);
        
        return response()->json([
            'status' => 'success',
            'actif' => $service->actif
        ]);
    }
}
