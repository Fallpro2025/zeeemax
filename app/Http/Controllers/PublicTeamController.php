<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class PublicTeamController extends Controller
{
    public function index()
    {
        $team = Team::where('actif', true)->orderBy('ordre')->get();
        return view('public.team.index', compact('team'));
    }
}

