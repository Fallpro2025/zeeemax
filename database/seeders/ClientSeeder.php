<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Seed the application's database with clients.
     */
    public function run(): void
    {
        $clients = [
            [
                'nom' => 'Onefliq',
                'type' => null,
                'logo_url' => null,
                'actif' => true,
                'ordre' => 1
            ],
            [
                'nom' => 'Zenda glow advice',
                'type' => null,
                'logo_url' => null,
                'actif' => true,
                'ordre' => 2
            ],
            [
                'nom' => 'Morray chic',
                'type' => null,
                'logo_url' => null,
                'actif' => true,
                'ordre' => 3
            ],
            [
                'nom' => 'Aikine',
                'type' => null,
                'logo_url' => null,
                'actif' => true,
                'ordre' => 4
            ],
            [
                'nom' => 'Amiminset',
                'type' => null,
                'logo_url' => null,
                'actif' => true,
                'ordre' => 5
            ],
            [
                'nom' => 'Table de Dakar',
                'type' => null,
                'logo_url' => null,
                'actif' => true,
                'ordre' => 6
            ],
            [
                'nom' => 'Cdalicious',
                'type' => null,
                'logo_url' => null,
                'actif' => true,
                'ordre' => 7
            ],
            [
                'nom' => 'Africain beauty queen',
                'type' => null,
                'logo_url' => null,
                'actif' => true,
                'ordre' => 8
            ],
        ];

        foreach ($clients as $client) {
            Client::firstOrCreate(
                ['nom' => $client['nom']],
                $client
            );
        }
    }
}
