<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\PortfolioItem;
use Illuminate\Support\Facades\File;

class DownloadPortfolioImages extends Command
{
    protected $signature = 'portfolio:download-images';
    protected $description = 'Télécharge les captures d\'écran des sites web du portfolio';

    public function handle()
    {
        $sites = [
            'codafrik' => 'https://codafrik.com/',
            'yonoutouki' => 'https://yonoutouki.com/',
            'graphiquen-signes' => 'http://graphiquenseignes.com',
            'agne-immobilier' => 'https://agneimmobilier.com/',
            'fadsr' => 'https://fadsr.sn/',
            'gestunews' => 'https://gestunews.com/',
            'topnews' => 'https://www.topnews.sn/',
            'sunumarket-business' => 'https://sunumarketbusiness.com/',
        ];

        // Créer le dossier si nécessaire
        $directory = public_path('images/portfolio');
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        foreach ($sites as $slug => $url) {
            $item = PortfolioItem::where('slug', $slug)->first();
            
            if (!$item) {
                $this->warn("Projet {$slug} non trouvé");
                continue;
            }

            try {
                // Utiliser un service de capture d'écran gratuit
                $screenshotUrl = "https://mini.s-shot.ru/1920x1080/PNG/1024/Z100/?{$url}";
                
                $this->info("Téléchargement de l'image pour {$item->titre}...");
                
                $response = Http::timeout(30)->get($screenshotUrl);
                
                if ($response->successful() && strlen($response->body()) > 1000) {
                    $imageData = $response->body();
                    $filename = "{$slug}.jpg";
                    $filepath = $directory . '/' . $filename;
                    
                    // Sauvegarder l'image
                    File::put($filepath, $imageData);
                    
                    // Mettre à jour l'item
                    $item->image_url = "images/portfolio/{$filename}";
                    $item->save();
                    
                    $this->info("✓ {$item->titre} : image téléchargée et sauvegardée");
                } else {
                    // Utiliser l'URL directe comme fallback
                    $item->image_url = $screenshotUrl;
                    $item->save();
                    $this->warn("✗ {$item->titre} : utilisation de l'URL directe (téléchargement échoué)");
                }
            } catch (\Exception $e) {
                $this->error("Erreur pour {$item->titre}: " . $e->getMessage());
            }
        }

        return Command::SUCCESS;
    }
}

