<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    private function checkAdminAuth()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        return null;
    }

    public function index()
    {
        if ($r = $this->checkAdminAuth()) return $r;
        $subs = Subscriber::orderByDesc('created_at')->paginate(20);
        return view('admin.newsletters.subscribers.index', compact('subs'));
    }

    public function create()
    {
        if ($r = $this->checkAdminAuth()) return $r;
        return view('admin.newsletters.subscribers.create');
    }

    public function store(Request $request)
    {
        if ($r = $this->checkAdminAuth()) return $r;
        $data = $request->validate([
            'email' => 'required|email|unique:subscribers,email',
            'prenom' => 'nullable|string|max:255',
            'nom' => 'nullable|string|max:255',
        ]);
        Subscriber::create([
            'email' => $data['email'],
            'prenom' => $data['prenom'] ?? null,
            'nom' => $data['nom'] ?? null,
            'source' => 'admin',
            'actif' => true,
        ]);
        return redirect()->route('admin.subscribers.index')->with('success', 'Abonné ajouté.');
    }

    public function toggle(Subscriber $subscriber)
    {
        if ($r = $this->checkAdminAuth()) return $r;
        $subscriber->update(['actif' => !$subscriber->actif]);
        return back()->with('success', 'Statut mis à jour.');
    }

    public function destroy(Subscriber $subscriber)
    {
        if ($r = $this->checkAdminAuth()) return $r;
        $subscriber->delete();
        return back()->with('success', 'Abonné supprimé.');
    }
}


