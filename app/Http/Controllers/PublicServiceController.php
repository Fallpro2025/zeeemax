<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class PublicServiceController extends Controller
{
    public function index()
    {
        $services = Service::actif()->ordre()->get();
        return view('public.services.index', compact('services'));
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)->where('actif', true)->firstOrFail();
        return view('public.services.show', compact('service'));
    }
}

