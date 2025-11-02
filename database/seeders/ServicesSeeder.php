<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Seed les services de la page d'accueil.
     */
    public function run(): void
    {
        $services = [
            [
                'titre' => 'Branding sur-mesure',
                'slug' => 'branding',
                'description' => 'Révélez votre identité unique avec un branding aligné à vos valeurs. Logo, charte graphique, identité visuelle complète qui vous ressemble.',
                'icone_svg' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>',
                'actif' => true,
                'ordre' => 1
            ],
            [
                'titre' => 'Communication alignée',
                'slug' => 'communication',
                'description' => 'Structurez votre communication pour toucher votre audience avec des messages percutants et cohérents qui reflètent votre essence.',
                'icone_svg' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>',
                'actif' => true,
                'ordre' => 2
            ],
            [
                'titre' => 'Stratégie digitale',
                'slug' => 'strategie-digitale',
                'description' => 'Développez votre visibilité en ligne avec une stratégie digitale impactante et des outils performants pour atteindre vos objectifs.',
                'icone_svg' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>',
                'actif' => true,
                'ordre' => 3
            ],
            [
                'titre' => 'Conception web',
                'slug' => 'conception-web',
                'description' => 'Créez votre site web sur-mesure : conception, développement, optimisation UX/UI pour un site performant, esthétique et adapté à vos objectifs.',
                'icone_svg' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>',
                'actif' => true,
                'ordre' => 4
            ],
            [
                'titre' => 'Application',
                'slug' => 'application',
                'description' => 'Développez votre application mobile Android et iOS. Solutions cross-platform performantes avec design moderne et expérience utilisateur optimale.',
                'icone_svg' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>',
                'actif' => true,
                'ordre' => 5
            ]
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(
                ['slug' => $service['slug']],
                $service
            );
        }
    }
}

