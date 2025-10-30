<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;

class PublicNewsletterController extends Controller
{
    public function index()
    {
        $articles = Newsletter::where('publie', true)
            ->orderByDesc('publie_le')
            ->orderByDesc('created_at')
            ->paginate(9);
        return view('public.newsletters.index', compact('articles'));
    }

    public function show(string $slug)
    {
        $article = Newsletter::where('slug', $slug)->where('publie', true)->firstOrFail();
        return view('public.newsletters.show', compact('article'));
    }
}


