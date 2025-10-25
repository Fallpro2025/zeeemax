<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\PortfolioItem;
use App\Models\Testimonial;
use App\Models\ContactMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer les Services
        $services = [
            [
                'titre' => 'Stratégie de Marque',
                'description' => 'Définition complète de votre identité de marque, positionnement concurrentiel et stratégie de communication sur-mesure.',
                'icone_svg' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364-.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>',
                'actif' => true,
                'ordre' => 1
            ],
            [
                'titre' => 'Identité Visuelle',
                'description' => 'Création de logos, chartes graphiques, supports de communication et déclinaisons digitales pour une cohérence parfaite.',
                'icone_svg' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"></path></svg>',
                'actif' => true,
                'ordre' => 2
            ],
            [
                'titre' => 'Marketing Digital',
                'description' => 'Stratégies digitales complètes : réseaux sociaux, SEO, publicités ciblées et création de contenus engageants.',
                'icone_svg' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>',
                'actif' => true,
                'ordre' => 3
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // Créer les éléments Portfolio
        $portfolioItems = [
            [
                'titre' => 'Rebranding EcoTech Solutions',
                'categorie' => 'Identité Visuelle',
                'description' => 'Refonte complète de l\'identité visuelle d\'une startup tech écoresponsable. Nouveau logo, charte graphique et supports de communication.',
                'image_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop',
                'technologies' => ['Adobe Illustrator', 'Photoshop', 'Figma'],
                'lien_demo' => 'https://behance.net/projet-ecotech',
                'featured' => true,
                'actif' => true,
                'ordre' => 1
            ],
            [
                'titre' => 'Campagne BioNatura',
                'categorie' => 'Marketing Digital',
                'description' => 'Stratégie digitale complète pour le lancement d\'une gamme de cosmétiques bio. +150% de visibilité en 3 mois.',
                'image_url' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=600&fit=crop',
                'technologies' => ['Instagram', 'Facebook Ads', 'Google Analytics'],
                'featured' => true,
                'actif' => true,
                'ordre' => 2
            ],
            [
                'titre' => 'Site Web Restaurant Le Moderne',
                'categorie' => 'Web Design',
                'description' => 'Création d\'un site web moderne et responsive pour un restaurant gastronomique avec système de réservation intégré.',
                'image_url' => 'https://images.unsplash.com/photo-1551632436-cbf8dd35adfa?w=800&h=600&fit=crop',
                'technologies' => ['WordPress', 'CSS3', 'JavaScript'],
                'lien_demo' => 'https://restaurant-lemoderne.fr',
                'actif' => true,
                'ordre' => 3
            ]
        ];

        foreach ($portfolioItems as $item) {
            PortfolioItem::create($item);
        }

        // Créer les Témoignages
        $testimonials = [
            [
                'nom_client' => 'Marie Dubois',
                'profession' => 'Directrice Marketing, EcoTech Solutions',
                'contenu' => 'L\'équipe ZEEEMAX a complètement transformé notre image de marque. Leur approche stratégique et leur créativité ont permis de repositionner notre entreprise avec succès.',
                'metrique' => '+45% de notoriété',
                'avatar_url' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=150&h=150&fit=crop&crop=face',
                'note' => 5,
                'featured' => true,
                'actif' => true,
                'ordre' => 1
            ],
            [
                'nom_client' => 'Thomas Laurent',
                'profession' => 'Fondateur, BioNatura',
                'contenu' => 'Grâce à ZEEEMAX, nous avons dépassé nos objectifs de vente dès le premier trimestre. Leur expertise en marketing digital est remarquable.',
                'metrique' => '+150% de ventes',
                'avatar_url' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face',
                'note' => 5,
                'featured' => true,
                'actif' => true,
                'ordre' => 2
            ],
            [
                'nom_client' => 'Sophie Chen',
                'profession' => 'Propriétaire, Restaurant Le Moderne',
                'contenu' => 'Notre nouveau site web et notre stratégie de communication ont révolutionné notre présence en ligne. Les réservations ont augmenté de 80%.',
                'metrique' => '+80% de réservations',
                'avatar_url' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop&crop=face',
                'note' => 5,
                'actif' => true,
                'ordre' => 3
            ]
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }

        // Créer des Messages de Contact
        $messages = [
            [
                'prenom' => 'Alexandre',
                'nom' => 'Martin',
                'email' => 'a.martin@startup-innovation.fr',
                'sujet' => 'Demande de devis pour refonte identité visuelle',
                'message' => 'Bonjour, je souhaiterais obtenir un devis pour la refonte complète de l\'identité visuelle de ma startup dans le domaine de l\'innovation technologique. Nous cherchons un positionnement moderne et dynamique.',
                'statut' => 'nouveau',
                'created_at' => Carbon::now()->subMinutes(15)
            ],
            [
                'prenom' => 'Julie',
                'nom' => 'Rousseau',
                'email' => 'julie.rousseau@fashion-co.com',
                'sujet' => 'Collaboration stratégie marketing digital',
                'message' => 'Nous aimerions discuter d\'une collaboration pour développer notre présence sur les réseaux sociaux et optimiser nos campagnes publicitaires. Notre budget annuel est de 50k€.',
                'statut' => 'nouveau',
                'created_at' => Carbon::now()->subHours(2)
            ],
            [
                'prenom' => 'Nicolas',
                'nom' => 'Bernard',
                'email' => 'n.bernard@consultingpro.fr',
                'sujet' => 'Formation équipe interne',
                'message' => 'Serait-il possible d\'organiser une formation pour notre équipe marketing sur les dernières tendances du branding ? Nous sommes 8 personnes.',
                'statut' => 'lu',
                'lu_le' => Carbon::now()->subHours(1),
                'created_at' => Carbon::now()->subDays(1)
            ]
        ];

        foreach ($messages as $message) {
            ContactMessage::create($message);
        }

        $this->command->info('Données de démonstration créées avec succès !');
        $this->command->info('- ' . count($services) . ' services');
        $this->command->info('- ' . count($portfolioItems) . ' éléments portfolio');
        $this->command->info('- ' . count($testimonials) . ' témoignages');
        $this->command->info('- ' . count($messages) . ' messages de contact');
    }
}
