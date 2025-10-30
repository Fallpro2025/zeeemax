<?php

namespace Database\Seeders;

use App\Models\Valeur;
use Illuminate\Database\Seeder;

class ValeurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $valeurs = [
            [
                'titre' => 'Innovation',
                'description' => 'Nous repoussons constamment les limites pour créer des solutions novatrices qui répondent aux besoins de demain.',
                'icon' => 'lightning',
                'couleur' => 'purple',
                'ordre' => 1,
                'actif' => true,
            ],
            [
                'titre' => 'Excellence',
                'description' => 'Nous visons l\'excellence dans chaque projet, en garantissant la plus haute qualité dans tout ce que nous entreprenons.',
                'icon' => 'shield',
                'couleur' => 'blue',
                'ordre' => 2,
                'actif' => true,
            ],
            [
                'titre' => 'Passion',
                'description' => 'Notre passion pour ce que nous faisons se reflète dans notre engagement et notre dévouement envers chaque client.',
                'icon' => 'heart',
                'couleur' => 'purple',
                'ordre' => 3,
                'actif' => true,
            ],
            [
                'titre' => 'Qualité',
                'description' => 'La qualité est au cœur de notre démarche. Chaque détail compte pour offrir une expérience exceptionnelle.',
                'icon' => 'star',
                'couleur' => 'blue',
                'ordre' => 4,
                'actif' => true,
            ],
            [
                'titre' => 'Croissance',
                'description' => 'Nous accompagnons nos clients dans leur croissance en proposant des solutions évolutives et performantes.',
                'icon' => 'rocket',
                'couleur' => 'purple',
                'ordre' => 5,
                'actif' => true,
            ],
            [
                'titre' => 'Précision',
                'description' => 'Notre approche méthodique et précise garantit des résultats optimaux pour chaque projet.',
                'icon' => 'target',
                'couleur' => 'blue',
                'ordre' => 6,
                'actif' => true,
            ],
            [
                'titre' => 'Équipe',
                'description' => 'Nous valorisons le travail d\'équipe et la collaboration pour créer des synergies et atteindre l\'excellence collective.',
                'icon' => 'users',
                'couleur' => 'purple',
                'ordre' => 7,
                'actif' => true,
            ],
            [
                'titre' => 'Confiance',
                'description' => 'La confiance est la base de toutes nos relations. Nous construisons des partenariats durables basés sur la transparence.',
                'icon' => 'handshake',
                'couleur' => 'blue',
                'ordre' => 8,
                'actif' => true,
            ],
        ];

        foreach ($valeurs as $valeur) {
            Valeur::create($valeur);
        }
    }
}

