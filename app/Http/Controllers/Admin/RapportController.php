<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RapportController extends Controller
{
    /**
     * Vérifier l'authentification admin
     */
    private function checkAdminAuth()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        return null;
    }

    /**
     * Afficher le dashboard des rapports
     */
    public function index(Request $request)
    {
        if ($redirect = $this->checkAdminAuth()) return $redirect;

        $period = $request->get('period', 30); // Par défaut 30 jours
        $startDate = now()->subDays($period);
        
        // Statistiques générales
        $stats = [
            'total_visites' => Visit::where('visited_at', '>=', $startDate)->count(),
            'visiteurs_uniques' => Visit::where('visited_at', '>=', $startDate)
                ->distinct('ip_address')
                ->count('ip_address'),
            'pages_vues' => Visit::where('visited_at', '>=', $startDate)->public()->count(),
            'temps_moyen' => Visit::where('visited_at', '>=', $startDate)
                ->whereNotNull('response_time')
                ->avg('response_time'),
        ];

        // Visites par jour (derniers 30 jours)
        $visites_par_jour = Visit::where('visited_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(visited_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->date => $item->count];
            });

        // Pages les plus visitées
        $pages_plus_visitees = Visit::where('visited_at', '>=', $startDate)
            ->select('url', DB::raw('COUNT(*) as count'))
            ->groupBy('url')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        // Répartition par appareil
        $appareils = Visit::where('visited_at', '>=', $startDate)
            ->select('device_type', DB::raw('COUNT(*) as count'))
            ->groupBy('device_type')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->device_type => $item->count];
            });

        // Répartition par navigateur
        $navigateurs = Visit::where('visited_at', '>=', $startDate)
            ->whereNotNull('browser')
            ->select('browser', DB::raw('COUNT(*) as count'))
            ->groupBy('browser')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        // Répartition par plateforme
        $plateformes = Visit::where('visited_at', '>=', $startDate)
            ->whereNotNull('platform')
            ->select('platform', DB::raw('COUNT(*) as count'))
            ->groupBy('platform')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        // Visites par heure de la journée
        $visites_par_heure = Visit::where('visited_at', '>=', now()->subDays(7))
            ->selectRaw('HOUR(visited_at) as hour, COUNT(*) as count')
            ->groupBy('hour')
            ->orderBy('hour', 'asc')
            ->get();

        // Routes les plus visitées
        $routes_plus_visitees = Visit::where('visited_at', '>=', $startDate)
            ->whereNotNull('route_name')
            ->select('route_name', DB::raw('COUNT(*) as count'))
            ->groupBy('route_name')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        // Visites récentes
        $visites_recentes = Visit::where('visited_at', '>=', $startDate)
            ->orderBy('visited_at', 'desc')
            ->limit(20)
            ->get();

        // Statistiques par période (comparaison)
        $stats_comparaison = [
            'actuel' => [
                'start' => $startDate,
                'end' => now(),
                'count' => Visit::whereBetween('visited_at', [$startDate, now()])->count(),
            ],
            'precedent' => [
                'start' => now()->subDays($period * 2),
                'end' => $startDate,
                'count' => Visit::whereBetween('visited_at', [now()->subDays($period * 2), $startDate])->count(),
            ],
        ];

        $evolution = ($stats_comparaison['precedent']['count'] > 0) 
            ? (($stats_comparaison['actuel']['count'] - $stats_comparaison['precedent']['count']) / $stats_comparaison['precedent']['count']) * 100 
            : 0;

        return view('admin.rapports.index', compact(
            'stats',
            'visites_par_jour',
            'pages_plus_visitees',
            'appareils',
            'navigateurs',
            'plateformes',
            'visites_par_heure',
            'routes_plus_visitees',
            'visites_recentes',
            'stats_comparaison',
            'evolution',
            'period'
        ));
    }
}
