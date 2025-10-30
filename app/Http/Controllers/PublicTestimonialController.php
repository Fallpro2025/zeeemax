<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class PublicTestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::where('actif', true)->orderBy('ordre')->get();
        return view('public.testimonials.index', compact('testimonials'));
    }
}

