<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Newsletter;
use Illuminate\Support\Str;

class NewsletterSeeder extends Seeder
{
    public function run(): void
    {
        if (Newsletter::count() > 0) return;

        $items = [
            [
                'titre' => 'Lancer sa marque: 5 étapes clés',
                'extrait' => 'De l’identité au go-to-market, notre méthode condensée.',
                'contenu' => "Découvrez les 5 étapes essentielles pour lancer votre marque:\n1) Clarifier votre positionnement\n2) Construire votre identité visuelle\n3) Valider votre offre\n4) Déployer vos canaux\n5) Optimiser en continu.",
            ],
            [
                'titre' => 'Booster sa visibilité sur Instagram',
                'extrait' => 'Formats, fréquence, et contenu qui convertit.',
                'contenu' => "Nous détaillons les formats performants, la fréquence recommandée et des idées de contenus qui engagent durablement.",
            ],
            [
                'titre' => 'Site web: les erreurs à éviter',
                'extrait' => 'Clarté, vitesse, et conversion: le trio gagnant.',
                'contenu' => "Votre site doit être clair, rapide et orienté conversion. Voici un check-list simple pour améliorer votre impact.",
            ],
        ];

        foreach ($items as $i) {
            Newsletter::create([
                'titre' => $i['titre'],
                'slug' => Str::slug($i['titre']).'-'.Str::random(6),
                'extrait' => $i['extrait'],
                'contenu' => $i['contenu'],
                'publie' => true,
                'publie_le' => now()->subDays(rand(0, 10)),
                'image_couverture' => 'https://picsum.photos/seed/'.Str::random(8).'/800/450',
            ]);
        }
    }
}


