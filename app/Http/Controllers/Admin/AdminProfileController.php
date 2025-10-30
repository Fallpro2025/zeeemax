<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
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
     * Afficher le profil de l'administrateur connecté
     */
    public function show()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $adminId = session('admin_id');
        if (!$adminId) {
            return redirect()->route('admin.login')->with('error', 'Session expirée. Veuillez vous reconnecter.');
        }
        
        $admin = Admin::find($adminId);
        if (!$admin) {
            return redirect()->route('admin.login')->with('error', 'Administrateur introuvable. Veuillez vous reconnecter.');
        }
        
        return view('admin.profile.index', compact('admin'));
    }

    /**
     * Mettre à jour le profil
     */
    public function update(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $adminId = session('admin_id');
        if (!$adminId) {
            return redirect()->route('admin.login')->with('error', 'Session expirée. Veuillez vous reconnecter.');
        }
        
        $admin = Admin::find($adminId);
        if (!$admin) {
            return redirect()->route('admin.login')->with('error', 'Administrateur introuvable. Veuillez vous reconnecter.');
        }
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id . '|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'telephone' => 'nullable|string|max:50',
            'current_password' => 'nullable|required_with:password|string',
        ]);

        // Vérifier le mot de passe actuel si changement de mot de passe
        if (!empty($validated['password'])) {
            if (empty($validated['current_password']) || !Hash::check($validated['current_password'], $admin->password)) {
                return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.'])->withInput();
            }
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        unset($validated['current_password']);
        
        $admin->update($validated);

        return redirect()->route('admin.profile.show')
            ->with('success', 'Profil mis à jour avec succès !');
    }
}

