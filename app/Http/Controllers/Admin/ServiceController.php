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
    public function index()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $services = Service::orderBy('ordre')->get();
        return view('admin.services.index', compact('services'));
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
            'icone_svg' => 'required|string',
            'actif' => 'boolean',
            'ordre' => 'integer|min:0'
        ]);

        // Si pas de slug fourni, il sera généré automatiquement par le modèle
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
            'icone_svg' => 'required|string',
            'actif' => 'boolean',
            'ordre' => 'integer|min:0'
        ]);

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
