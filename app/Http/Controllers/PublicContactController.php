<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PublicContactController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::first();
        return view('public.contact.index', compact('settings'));
    }
}

