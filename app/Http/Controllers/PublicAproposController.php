<?php

namespace App\Http\Controllers;

use App\Models\Apropos;
use App\Models\Team;
use App\Models\Valeur;
use Illuminate\Http\Request;

class PublicAproposController extends Controller
{
    public function index()
    {
        $apropos = Apropos::first();
        $team = Team::where('actif', true)->orderBy('ordre')->get();
        $valeurs = Valeur::where('actif', true)->orderBy('ordre')->get();
        return view('public.apropos.index', compact('apropos', 'team', 'valeurs'));
    }
}

