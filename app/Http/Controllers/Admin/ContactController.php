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
    public function index(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;
        
        // Récupérer les paramètres de recherche et filtre
        $search = $request->get('search', '');
        $statut = $request->get('statut', 'all'); // 'all', 'nouveau', 'lu', 'archive'
        $sortBy = $request->get('sort_by', 'created_at'); // 'created_at', 'prenom', 'nom', 'email', 'updated_at'
        $sortOrder = $request->get('sort_order', 'desc'); // 'asc', 'desc'
        
        // Construire la requête
        $query = ContactMessage::query();
        
        // Appliquer la recherche
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('prenom', 'like', "%{$search}%")
                  ->orWhere('nom', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('sujet', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }
        
        // Appliquer le filtre de statut
        if ($statut === 'nouveau') {
            $query->where('statut', 'nouveau');
        } elseif ($statut === 'lu') {
            $query->where('statut', 'lu');
        } elseif ($statut === 'archive') {
            $query->where('statut', 'archive');
        }
        
        // Appliquer le tri
        $query->orderBy($sortBy, $sortOrder);
        
        $messages = $query->get();
        
        return view('admin.contacts.index', compact('messages', 'search', 'statut', 'sortBy', 'sortOrder'));
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
        
        $validated = $request->validate([
            'notes_admin' => 'nullable|string'
        ]);
        
        $contact->update($validated);
        
        return response()->json([
            'status' => 'success',
            'notes' => $contact->notes_admin
        ]);
    }

    /**
     * Marquer tous les messages comme lus (AJAX)
     */
    public function markAllAsRead(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }
        
        $ids = $request->input('ids', []);
        
        if (empty($ids)) {
            // Marquer tous les messages nouveaux comme lus
            $messagesNonLus = ContactMessage::where('statut', 'nouveau')->get();
            $count = $messagesNonLus->count();
            $messagesNonLus->each(function($message) {
                $message->marquerCommeLu();
            });
        } else {
            // Marquer seulement les messages sélectionnés
            $messages = ContactMessage::whereIn('id', $ids)
                ->where('statut', 'nouveau')
                ->get();
            $count = $messages->count();
            $messages->each(function($message) {
                $message->marquerCommeLu();
            });
        }
        
        return response()->json([
            'status' => 'success',
            'message' => $count . ' message(s) marqué(s) comme lu(s)',
            'count' => $count
        ]);
    }

    /**
     * Archiver des messages sélectionnés (AJAX)
     */
    public function archiveSelected(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }
        
        $idsJson = $request->input('ids', '[]');
        $ids = json_decode($idsJson, true) ?: [];
        
        if (empty($ids)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Aucun message sélectionné'
            ], 400);
        }
        
        $messages = ContactMessage::whereIn('id', $ids)
            ->where('statut', '!=', 'archive')
            ->get();
        $count = $messages->count();
        
        $messages->each(function($message) {
            $message->archiver();
        });
        
        return response()->json([
            'status' => 'success',
            'message' => $count . ' message(s) archivé(s)',
            'count' => $count
        ]);
    }
}
