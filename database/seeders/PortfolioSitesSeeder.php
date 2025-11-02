<?php

namespace Database\Seeders;

use App\Models\PortfolioItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortfolioSitesSeeder extends Seeder
{
    /**
     * Seed les sites internet réalisés dans le portfolio.
     */
    public function run(): void
    {
        $sites = [
            [
                'titre' => 'CodAfrik',
                'slug' => 'codafrik',
                'categorie' => 'Site Internet',
                'description' => 'Plateforme leader du développement technologique au Sénégal. CodAfrik accompagne les entreprises africaines dans leur transformation digitale avec des solutions sur-mesure, une expertise reconnue et un service d\'excellence.',
                'image_url' => 'https://api.thumbnail.ws/api/thumbnail/get?url=https://codafrik.com&width=1920&height=1080',
                'lien_demo' => 'https://codafrik.com/',
                'technologies' => ['Laravel', 'React', 'Vue.js', 'PHP'],
                'actif' => true,
                'featured' => true,
                'ordre' => 1
            ],
            [
                'titre' => 'YonouTouki',
                'slug' => 'yonoutouki',
                'categorie' => 'Site Internet',
                'description' => 'Plateforme guidant les voyageurs dans leurs démarches administratives liées aux visas. YonouTouki simplifie, guide et sécurise toutes vos démarches de voyage.',
                'image_url' => 'https://api.thumbnail.ws/api/thumbnail/get?url=https://yonoutouki.com&width=1920&height=1080',
                'lien_demo' => 'https://yonoutouki.com/',
                'technologies' => ['WordPress', 'PHP', 'JavaScript'],
                'actif' => true,
                'featured' => true,
                'ordre' => 2
            ],
            [
                'titre' => 'Graphiquen Signes',
                'slug' => 'graphiquen-signes',
                'categorie' => 'Identité visuelle',
                'description' => 'Site vitrine pour une entreprise spécialisée dans la création graphique et les enseignes. Design moderne et professionnel mettant en avant les réalisations.',
                'image_url' => 'https://api.thumbnail.ws/api/thumbnail/get?url=http://graphiquenseignes.com&width=1920&height=1080',
                'lien_demo' => 'http://graphiquenseignes.com',
                'technologies' => ['HTML', 'CSS', 'JavaScript'],
                'actif' => true,
                'featured' => false,
                'ordre' => 3
            ],
            [
                'titre' => 'Agne Immobilier',
                'slug' => 'agne-immobilier',
                'categorie' => 'Site Internet',
                'description' => 'Plateforme immobilière moderne pour la gestion et la mise en avant de propriétés. Interface intuitive pour les acheteurs et vendeurs.',
                'image_url' => 'https://api.thumbnail.ws/api/thumbnail/get?url=https://agneimmobilier.com&width=1920&height=1080',
                'lien_demo' => 'https://agneimmobilier.com/',
                'technologies' => ['Laravel', 'Vue.js', 'MySQL'],
                'actif' => true,
                'featured' => true,
                'ordre' => 4
            ],
            [
                'titre' => 'FADSR',
                'slug' => 'fadsr',
                'categorie' => 'Site Internet',
                'description' => 'Site institutionnel pour une organisation sénégalaise. Design élégant et informatif présentant les activités et missions de l\'organisation.',
                'image_url' => 'https://api.thumbnail.ws/api/thumbnail/get?url=https://fadsr.sn&width=1920&height=1080',
                'lien_demo' => 'https://fadsr.sn/',
                'technologies' => ['WordPress', 'PHP'],
                'actif' => true,
                'featured' => false,
                'ordre' => 5
            ],
            [
                'titre' => 'GestuNews',
                'slug' => 'gestunews',
                'categorie' => 'Site Internet',
                'description' => 'Plateforme d\'actualités et de gestion de contenu éditorial. Système moderne de publication et gestion d\'articles avec interface intuitive.',
                'image_url' => 'https://api.thumbnail.ws/api/thumbnail/get?url=https://gestunews.com&width=1920&height=1080',
                'lien_demo' => 'https://gestunews.com/',
                'technologies' => ['Laravel', 'Vue.js', 'MySQL'],
                'actif' => true,
                'featured' => false,
                'ordre' => 6
            ],
            [
                'titre' => 'TopNews',
                'slug' => 'topnews',
                'categorie' => 'Site Internet',
                'description' => 'Média d\'information en ligne offrant les actualités les plus importantes du Sénégal et d\'Afrique. Design responsive et performance optimisée.',
                'image_url' => 'https://api.thumbnail.ws/api/thumbnail/get?url=https://www.topnews.sn&width=1920&height=1080',
                'lien_demo' => 'https://www.topnews.sn/',
                'technologies' => ['WordPress', 'PHP', 'JavaScript'],
                'actif' => true,
                'featured' => true,
                'ordre' => 7
            ],
            [
                'titre' => 'SunuMarket Business',
                'slug' => 'sunumarket-business',
                'categorie' => 'Site Internet',
                'description' => 'Plateforme e-commerce et marketplace pour les entreprises. Solution complète de vente en ligne avec gestion de produits et commandes.',
                'image_url' => 'https://api.thumbnail.ws/api/thumbnail/get?url=https://sunumarketbusiness.com&width=1920&height=1080',
                'lien_demo' => 'https://sunumarketbusiness.com/',
                'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Payment Gateway'],
                'actif' => true,
                'featured' => true,
                'ordre' => 8
            ],
        ];

        foreach ($sites as $site) {
            PortfolioItem::firstOrCreate(
                ['slug' => $site['slug']],
                $site
            );
        }
    }
}

