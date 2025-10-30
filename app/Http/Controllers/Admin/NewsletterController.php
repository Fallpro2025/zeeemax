<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterBroadcast;
use App\Models\Subscriber;

class NewsletterController extends Controller
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
        $posts = Newsletter::orderByDesc('created_at')->paginate(15);
        return view('admin.newsletters.index', compact('posts'));
    }

    public function create()
    {
        if ($r = $this->checkAdminAuth()) return $r;
        return view('admin.newsletters.create');
    }

    public function store(Request $request)
    {
        if ($r = $this->checkAdminAuth()) return $r;

        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_posts,slug',
            'extrait' => 'nullable|string|max:500',
            'categorie' => 'nullable|string|max:100',
            'contenu' => 'required|string',
            'image_couverture' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'publie' => 'sometimes|boolean',
            'publie_le' => 'nullable|date',
        ]);

        $slug = $data['slug'] ?? Str::slug($data['titre']).'-'.Str::random(6);

        $imagePath = null;
        if ($request->hasFile('image_couverture')) {
            $imagePath = $request->file('image_couverture')->store('images/site', 'public');
            $imagePath = 'storage/'.$imagePath;
        }

        Newsletter::create([
            'titre' => $data['titre'],
            'slug' => $slug,
            'extrait' => $data['extrait'] ?? null,
            'categorie' => $data['categorie'] ?? null,
            'contenu' => $data['contenu'],
            'image_couverture' => $imagePath,
            'publie' => (bool)($data['publie'] ?? false),
            'publie_le' => $data['publie_le'] ?? null,
        ]);

        return redirect()->route('admin.newsletters.index')->with('success', 'Newsletter créée.');
    }

    public function edit(Newsletter $newsletter)
    {
        if ($r = $this->checkAdminAuth()) return $r;
        return view('admin.newsletters.edit', ['post' => $newsletter]);
    }

    public function update(Request $request, Newsletter $newsletter)
    {
        if ($r = $this->checkAdminAuth()) return $r;

        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_posts,slug,'.$newsletter->id,
            'extrait' => 'nullable|string|max:500',
            'categorie' => 'nullable|string|max:100',
            'contenu' => 'required|string',
            'image_couverture' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'publie' => 'sometimes|boolean',
            'publie_le' => 'nullable|date',
        ]);

        $imagePath = $newsletter->image_couverture;
        if ($request->hasFile('image_couverture')) {
            $imagePath = $request->file('image_couverture')->store('images/site', 'public');
            $imagePath = 'storage/'.$imagePath;
        }

        $newsletter->update([
            'titre' => $data['titre'],
            'slug' => $data['slug'] ?: $newsletter->slug,
            'extrait' => $data['extrait'] ?? null,
            'categorie' => $data['categorie'] ?? null,
            'contenu' => $data['contenu'],
            'image_couverture' => $imagePath,
            'publie' => (bool)($data['publie'] ?? false),
            'publie_le' => $data['publie_le'] ?? null,
        ]);

        return redirect()->route('admin.newsletters.index')->with('success', 'Newsletter mise à jour.');
    }

    public function destroy(Newsletter $newsletter)
    {
        if ($r = $this->checkAdminAuth()) return $r;
        $newsletter->delete();
        return redirect()->route('admin.newsletters.index')->with('success', 'Newsletter supprimée.');
    }

    public function send(Newsletter $newsletter)
    {
        if ($r = $this->checkAdminAuth()) return $r;

        try {
            $emails = Subscriber::where('actif', true)->whereNull('unsubscribed_at')->pluck('email')->all();
            if (empty($emails)) {
                return back()->with('error', 'Aucun abonné actif à qui envoyer.');
            }
            $to = array_shift($emails);
            $mailer = Mail::to($to);
            if (!empty($emails)) {
                $mailer->bcc($emails);
            }
            $mailer->send(new NewsletterBroadcast($newsletter));
            return back()->with('success', 'Newsletter envoyée par email.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Erreur lors de l\'envoi: '.$e->getMessage());
        }
    }
}


