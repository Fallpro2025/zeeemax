<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use Illuminate\Http\Request;

class PublicPortfolioController extends Controller
{
    public function index()
    {
        $portfolioItems = PortfolioItem::actif()->ordre()->get();
        $categories = PortfolioItem::actif()->distinct()->pluck('categorie')->filter()->sort()->values();
        return view('public.portfolio.index', compact('portfolioItems', 'categories'));
    }

    public function show($slug)
    {
        $item = PortfolioItem::where('slug', $slug)->where('actif', true)->firstOrFail();
        return view('public.portfolio.show', compact('item'));
    }
}

