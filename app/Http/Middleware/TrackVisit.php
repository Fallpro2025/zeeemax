<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visit;
use Illuminate\Support\Facades\Log;

class TrackVisit
{
    /**
     * Enregistrer une visite dans la base de données
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);
        
        // Exclure les routes admin et les requêtes AJAX
        if (str_contains($request->path(), 'admin') || 
            $request->ajax() || 
            $request->expectsJson()) {
            return $next($request);
        }

        $response = $next($request);
        
        // Calculer le temps de réponse
        $responseTime = (microtime(true) - $startTime) * 1000;

        // Enregistrer la visite de manière asynchrone pour ne pas ralentir la réponse
        try {
            $this->recordVisit($request, $response, $responseTime);
        } catch (\Exception $e) {
            // Logger l'erreur mais ne pas bloquer la réponse
            Log::error('Erreur lors de l\'enregistrement de la visite: ' . $e->getMessage());
        }

        return $response;
    }

    /**
     * Enregistrer les détails de la visite
     */
    private function recordVisit(Request $request, Response $response, float $responseTime): void
    {
        $userAgent = $request->userAgent();
        $deviceInfo = $this->parseUserAgent($userAgent);

        Visit::create([
            'ip_address' => $request->ip(),
            'user_agent' => $userAgent,
            'url' => $request->fullUrl(),
            'route_name' => $request->route()?->getName(),
            'method' => $request->method(),
            'referer' => $request->header('referer'),
            'device_type' => $deviceInfo['device'],
            'browser' => $deviceInfo['browser'],
            'platform' => $deviceInfo['platform'],
            'status_code' => $response->getStatusCode(),
            'response_time' => (int) $responseTime,
            'visited_at' => now(),
        ]);
    }

    /**
     * Analyser le User-Agent pour extraire les informations
     */
    private function parseUserAgent(?string $userAgent): array
    {
        if (!$userAgent) {
            return ['device' => 'unknown', 'browser' => 'unknown', 'platform' => 'unknown'];
        }

        $device = 'desktop';
        $browser = 'unknown';
        $platform = 'unknown';

        // Détection du type d'appareil
        if (preg_match('/(mobile|android|iphone|ipad)/i', $userAgent)) {
            $device = 'mobile';
            if (preg_match('/ipad/i', $userAgent)) {
                $device = 'tablet';
            }
        }

        // Détection du navigateur
        if (preg_match('/Chrome/i', $userAgent) && !preg_match('/Edg|OPR/i', $userAgent)) {
            $browser = 'Chrome';
        } elseif (preg_match('/Firefox/i', $userAgent)) {
            $browser = 'Firefox';
        } elseif (preg_match('/Safari/i', $userAgent) && !preg_match('/Chrome/i', $userAgent)) {
            $browser = 'Safari';
        } elseif (preg_match('/Edg/i', $userAgent)) {
            $browser = 'Edge';
        } elseif (preg_match('/OPR/i', $userAgent)) {
            $browser = 'Opera';
        }

        // Détection de la plateforme
        if (preg_match('/Windows/i', $userAgent)) {
            $platform = 'Windows';
        } elseif (preg_match('/Mac/i', $userAgent)) {
            $platform = 'macOS';
        } elseif (preg_match('/Linux/i', $userAgent)) {
            $platform = 'Linux';
        } elseif (preg_match('/Android/i', $userAgent)) {
            $platform = 'Android';
        } elseif (preg_match('/iPhone|iPad/i', $userAgent)) {
            $platform = 'iOS';
        }

        return [
            'device' => $device,
            'browser' => $browser,
            'platform' => $platform,
        ];
    }
}
