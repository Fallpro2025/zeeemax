<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\PortfolioItem;
use App\Models\Testimonial;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Afficher la page de connexion admin
     */
    public function showLogin()
    {
        return view('admin.login');
    }

    /**
     * Traiter la connexion admin
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Identifiants admin temporaires (à changer)
        $adminEmail = 'admin@zeeemax.com';
        $adminPassword = 'ZeeeMax2024!';

        if ($request->email === $adminEmail && $request->password === $adminPassword) {
            // Connexion réussie - on peut stocker en session
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ])->withInput();
    }

    /**
     * Tableau de bord admin
     */
    public function dashboard()
    {
        // Vérifier si admin connecté
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Statistiques réelles depuis MySQL
        $stats = [
            'services' => [
                'total' => Service::count(),
                'actifs' => Service::actif()->count(),
                'recent' => Service::where('created_at', '>=', now()->subDays(30))->count()
            ],
            'portfolio' => [
                'total' => PortfolioItem::count(),
                'actifs' => PortfolioItem::actif()->count(),
                'featured' => PortfolioItem::featured()->count()
            ],
            'testimonials' => [
                'total' => Testimonial::count(),
                'actifs' => Testimonial::actif()->count(),
                'featured' => Testimonial::featured()->count()
            ],
            'contacts' => [
                'total' => ContactMessage::count(),
                'nonLus' => ContactMessage::nonLu()->count(),
                'recent' => ContactMessage::where('created_at', '>=', now()->subDays(7))->count()
            ]
        ];

        // Activités récentes réelles
        $activitesRecentes = [
            'nouveauxMessages' => ContactMessage::recent()->take(5)->get(),
            'derniersServices' => Service::latest()->take(3)->get(),
            'dernierPortfolio' => PortfolioItem::latest()->take(3)->get()
        ];

        return view('admin.dashboard', compact('stats', 'activitesRecentes'));
    }

    /**
     * Déconnexion admin
     */
    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login')->with('message', 'Déconnexion réussie');
    }
}