<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
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
     * Afficher la liste des messages de contact
     */
    public function index()
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $messages = ContactMessage::recent()->get();
        return view('admin.contacts.index', compact('messages'));
    }

    /**
     * Afficher un message spécifique
     */
    public function show(ContactMessage $contact)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        // Marquer automatiquement comme lu si ce n'est pas déjà fait
        if ($contact->statut === 'nouveau') {
            $contact->marquerCommeLu();
        }
        
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Supprimer un message
     */
    public function destroy(ContactMessage $contact)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Message supprimé avec succès !');
    }

    /**
     * Marquer un message comme lu (AJAX)
     */
    public function markAsRead(ContactMessage $contact)
    {
        if ($redirect = $this->checkAdminAuth()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }
        
        $contact->marquerCommeLu();
        
        return response()->json([
            'status' => 'success',
            'statut' => $contact->statut,
            'lu_le' => $contact->lu_le?->format('d/m/Y H:i')
        ]);
    }

    /**
     * Archiver un message (AJAX)
     */
    public function archive(ContactMessage $contact)
    {
        if ($redirect = $this->checkAdminAuth()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }
        
        $contact->archiver();
        
        return response()->json([
            'status' => 'success',
            'statut' => $contact->statut
        ]);
    }

    /**
     * Mettre à jour les notes admin (AJAX)
     */
    public function updateNotes(Request $request, ContactMessage $contact)
    {
        if ($redirect = $this->checkAdminAuth()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }
        
        $request->validate([
            'notes_admin' => 'nullable|string'
        ]);
        
        $contact->update(['notes_admin' => $request->notes_admin]);
        
        return response()->json([
            'status' => 'success',
            'notes' => $contact->notes_admin
        ]);
    }
}
