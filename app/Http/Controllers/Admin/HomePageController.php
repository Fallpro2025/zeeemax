<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePageSetting;
use Illuminate\Http\Request;

class HomePageController extends Controller
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
     * Afficher le formulaire de configuration de l'accueil
     */
    public function index()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        // Récupérer ou créer la configuration (singleton)
        $homepage = HomePageSetting::first();
        if (!$homepage) {
            $homepage = HomePageSetting::create([]);
        }
        
        return view('admin.homepage.index', compact('homepage'));
    }

    /**
     * Mettre à jour la configuration de l'accueil
     */
    public function update(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $validated = $request->validate([
            'titre' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'background_type' => 'nullable|in:image,video',
            'background_image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'background_video_url' => 'nullable|string|max:500',
            'background_video_file' => 'nullable|mimetypes:video/mp4,video/webm,video/ogg|max:51200',
            'bouton_texte' => 'nullable|string|max:100',
            'bouton_url' => 'nullable|string|max:500',
        ]);

        // Récupérer ou créer la configuration
        $homepage = HomePageSetting::first();
        if (!$homepage) {
            $homepage = HomePageSetting::create([]);
        }

        // Gérer l'upload de l'image de background
        if ($request->hasFile('background_image_file')) {
            // Supprimer l'ancienne image si elle existe et n'est pas un URL externe
            if ($homepage->background_image_url && !str_starts_with($homepage->background_image_url, 'http') && file_exists(public_path($homepage->background_image_url))) {
                unlink(public_path($homepage->background_image_url));
            }
            
            // Uploader la nouvelle image
            $image = $request->file('background_image_file');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/homepage'), $imageName);
            $validated['background_image_url'] = 'images/homepage/' . $imageName;
        }

        // Si background_type est vidéo, supprimer l'image
        if ($validated['background_type'] === 'video') {
            if ($homepage->background_image_url && !str_starts_with($homepage->background_image_url, 'http') && file_exists(public_path($homepage->background_image_url))) {
                unlink(public_path($homepage->background_image_url));
            }
            $validated['background_image_url'] = null;
            // Upload vidéo si fournie
            if ($request->hasFile('background_video_file')) {
                // Supprimer ancienne vidéo locale si existante
                if ($homepage->background_video_url && !str_starts_with($homepage->background_video_url, 'http') && file_exists(public_path($homepage->background_video_url))) {
                    unlink(public_path($homepage->background_video_url));
                }
                $video = $request->file('background_video_file');
                $videoName = time() . '_' . uniqid() . '.' . $video->getClientOriginalExtension();
                $video->move(public_path('images/homepage'), $videoName);
                $validated['background_video_url'] = 'images/homepage/' . $videoName;
            }
        }

        // Si background_type est image, supprimer la vidéo
        if ($validated['background_type'] === 'image') {
            $validated['background_video_url'] = null;
            // Optionnel: supprimer ancienne vidéo locale
            if ($homepage->background_video_url && !str_starts_with($homepage->background_video_url, 'http') && file_exists(public_path($homepage->background_video_url))) {
                @unlink(public_path($homepage->background_video_url));
            }
        }

        $homepage->update($validated);

        return redirect()->route('admin.homepage.index')
            ->with('success', 'Configuration de l\'accueil mise à jour avec succès !');
    }
}

