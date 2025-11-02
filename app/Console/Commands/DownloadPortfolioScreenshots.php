<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\PortfolioItem;

class DownloadPortfolioScreenshots extends Command
{
    protected $signature = 'portfolio:download-screenshots';
    protected $description = 'Télécharge les captures d\'écran des sites web du portfolio';

    public function handle()
    {
        $sites = [
            'https://codafrik.com/' => 'codafrik',
            'https://yonoutouki.com/' => 'yonoutouki',
            'http://graphiquenseignes.com' => 'graphiquen-signes',
            'https://agneimmobilier.com/' => 'agne-immobilier',
            'https://fadsr.sn/' => 'fadsr',
            'https://gestunews.com/' => 'gestunews',
            'https://www.topnews.sn/' => 'topnews',
            'https://sunumarketbusiness.com/' => 'sunumarket-business',
        ];

        foreach ($sites as $url => $slug) {
            $item = PortfolioItem::where('slug', $slug)->first();
            
            if (!$item) {
                $this->warn("Projet {$slug} non trouvé");
                continue;
            }

            try {
                // Utiliser un service de capture d'écran
                $screenshotUrl = "https://api.thumbnail.ws/api/thumbnail/get?url=" . urlencode($url) . "&width=1920&height=1080";
                
                // Ou utiliser screenshot.guru
                // $screenshotUrl = "https://screenshot.guru/" . urlencode($url);
                
                $response = Http::timeout(30)->get($screenshotUrl);
                
                if ($response->successful()) {
                    $imageData = $response->body();
                    $filename = "portfolio/{$slug}.jpg";
                    
                    // Créer le dossier si nécessaire
                    if (!Storage::disk('public')->exists('portfolio')) {
                        Storage::disk('public')->makeDirectory('portfolio');
                    }
                    
                    // Sauvegarder l'image
                    Storage::disk('public')->put($filename, $imageData);
                    
                    // Mettre à jour l'item
                    $item->image_url = "storage/{$filename}";
                    $item->save();
                    
                    $this->info("✓ {$item->titre} : image téléchargée");
                } else {
                    $this->warn("✗ {$item->titre} : échec du téléchargement");
                }
            } catch (\Exception $e) {
                $this->error("Erreur pour {$item->titre}: " . $e->getMessage());
            }
        }

        return Command::SUCCESS;
    }
}

