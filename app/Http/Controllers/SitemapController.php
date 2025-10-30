<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Générer le sitemap XML dynamique
     */
    public function index()
    {
        $urls = [];
        $baseUrl = url('/');
        $now = now()->toAtomString();
        
        // Page d'accueil
        $urls[] = [
            'loc' => $baseUrl,
            'lastmod' => $now,
            'changefreq' => 'daily',
            'priority' => '1.0'
        ];
        
        // Pages statiques
        $staticPages = [
            ['url' => route('services.index'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('portfolio.index'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('apropos.index'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('testimonials.index'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => route('team.index'), 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => route('contact.index'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('newsletter.index'), 'priority' => '0.7', 'changefreq' => 'weekly'],
        ];
        
        foreach ($staticPages as $page) {
            $urls[] = [
                'loc' => $page['url'],
                'lastmod' => $now,
                'changefreq' => $page['changefreq'],
                'priority' => $page['priority']
            ];
        }
        
        // Services actifs
        $services = Service::actif()->orderBy('ordre')->get();
        foreach ($services as $service) {
            $urls[] = [
                'loc' => route('services.show', $service->slug),
                'lastmod' => $service->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8'
            ];
        }
        
        // Portfolio actifs
        $portfolioItems = PortfolioItem::actif()->get();
        foreach ($portfolioItems as $item) {
            $urls[] = [
                'loc' => route('portfolio.show', $item->slug),
                'lastmod' => $item->updated_at->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.7'
            ];
        }
        
        // Générer le XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        foreach ($urls as $url) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . htmlspecialchars($url['loc']) . "</loc>\n";
            $xml .= "    <lastmod>" . $url['lastmod'] . "</lastmod>\n";
            $xml .= "    <changefreq>" . $url['changefreq'] . "</changefreq>\n";
            $xml .= "    <priority>" . $url['priority'] . "</priority>\n";
            $xml .= "  </url>\n";
        }
        
        $xml .= '</urlset>';
        
        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }
    
    /**
     * Générer le fichier robots.txt dynamique
     */
    public function robots()
    {
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin/\n";
        $content .= "Disallow: /admin-*\n\n";
        $content .= "# Sitemap\n";
        $content .= "Sitemap: " . url('/sitemap.xml') . "\n";
        
        return response($content, 200)
            ->header('Content-Type', 'text/plain; charset=utf-8');
    }
}
