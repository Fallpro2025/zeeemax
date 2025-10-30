<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
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
     * Afficher la liste des administrateurs
     */
    public function index()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $admins = Admin::orderBy('created_at', 'desc')->get();
        
        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.admins.create');
    }

    /**
     * Enregistrer un nouvel administrateur
     */
    public function store(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'telephone' => 'nullable|string|max:50',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['actif'] = $request->has('actif') ? true : false;

        Admin::create($validated);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Administrateur créé avec succès !');
    }

    /**
     * Afficher un administrateur
     */
    public function show(Admin $admin)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.admins.show', compact('admin'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Admin $admin)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Mettre à jour un administrateur
     */
    public function update(Request $request, Admin $admin)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id . '|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'telephone' => 'nullable|string|max:50',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['actif'] = $request->has('actif') ? true : false;

        $admin->update($validated);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Administrateur mis à jour avec succès !');
    }

    /**
     * Supprimer un administrateur
     */
    public function destroy(Admin $admin)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        // Empêcher la suppression s'il n'y a qu'un seul administrateur
        $totalAdmins = Admin::count();
        if ($totalAdmins <= 1) {
            return redirect()->route('admin.admins.index')
                ->with('error', 'Impossible de supprimer le dernier administrateur ! Il doit rester au moins un administrateur dans le système.');
        }
        
        // Empêcher la suppression de soi-même
        $currentAdminId = session('admin_id');
        if ($admin->id == $currentAdminId) {
            return redirect()->route('admin.admins.index')
                ->with('error', 'Vous ne pouvez pas supprimer votre propre compte !');
        }
        
        $admin->delete();

        return redirect()->route('admin.admins.index')
            ->with('success', 'Administrateur supprimé avec succès !');
    }

    /**
     * Toggle le statut actif/inactif
     */
    public function toggle(Admin $admin)
    {
        if ($redirect = $this->checkAdminAuth()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }
        
        $admin->update(['actif' => !$admin->actif]);
        
        return response()->json([
            'status' => 'success',
            'actif' => $admin->actif
        ]);
    }
}

