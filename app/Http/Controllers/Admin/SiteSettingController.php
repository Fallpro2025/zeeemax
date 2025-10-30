<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
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
     * Afficher le formulaire de paramétrage
     */
    public function index()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        // Récupérer ou créer la configuration (singleton)
        $settings = SiteSetting::first();
        if (!$settings) {
            $settings = SiteSetting::create([]);
        }
        
        return view('admin.site-settings.index', compact('settings'));
    }

    /**
     * Mettre à jour les paramètres du site
     */
    public function update(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $validated = $request->validate([
            'nom_site' => 'nullable|string|max:255',
            'logo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description_site' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'telephone' => 'nullable|string|max:50',
            'adresse' => 'nullable|string|max:500',
            'ville' => 'nullable|string|max:100',
            'code_postal' => 'nullable|string|max:20',
            'pays' => 'nullable|string|max:100',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255'
        ]);

        // Récupérer ou créer la configuration
        $settings = SiteSetting::first();
        if (!$settings) {
            $settings = SiteSetting::create([]);
        }

        // Gérer l'upload du logo
        if ($request->hasFile('logo_file')) {
            // Supprimer l'ancien logo si il existe et n'est pas un URL externe
            if ($settings->logo_url && !str_starts_with($settings->logo_url, 'http') && file_exists(public_path($settings->logo_url))) {
                unlink(public_path($settings->logo_url));
            }
            
            // Uploader le nouveau logo
            $logo = $request->file('logo_file');
            $logoName = time() . '_' . uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('images/site'), $logoName);
            $validated['logo_url'] = 'images/site/' . $logoName;
        }

        $settings->update($validated);

        return redirect()->route('admin.site-settings.index')
            ->with('success', 'Paramètres du site mis à jour avec succès !');
    }
}

