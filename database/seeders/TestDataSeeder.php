<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\PortfolioItem;
use App\Models\Testimonial;
use App\Models\ContactMessage;
use App\Models\Partner;
use App\Models\Team;
use App\Models\SiteSetting;
use App\Models\HomePageSetting;
use App\Models\Apropos;
use App\Models\Newsletter;
use App\Models\Valeur;
use App\Models\Subscriber;
use App\Models\Admin;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        // SERVICES - 3 enregistrements
        $services = [
            [
                'titre' => 'Stratégie de Marque',
                'slug' => 'strategie-de-marque',
                'description' => 'Définition complète de votre identité de marque, positionnement concurrentiel et stratégie de communication sur-mesure pour révéler votre essence.',
                'icone_svg' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364-.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>',
                'actif' => true,
                'ordre' => 1
            ],
            [
                'titre' => 'Identité Visuelle',
                'slug' => 'identite-visuelle',
                'description' => 'Création de logos, chartes graphiques, supports de communication et déclinaisons digitales pour une cohérence parfaite et mémorable.',
                'icone_svg' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"></path></svg>',
                'actif' => true,
                'ordre' => 2
            ],
            [
                'titre' => 'Marketing Digital',
                'slug' => 'marketing-digital',
                'description' => 'Stratégies digitales complètes : réseaux sociaux, SEO, publicités ciblées et création de contenus engageants pour maximiser votre visibilité.',
                'icone_svg' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>',
                'actif' => true,
                'ordre' => 3
            ]
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(['slug' => $service['slug']], $service);
        }

        // PORTFOLIO ITEMS - 1 enregistrement (uniquement Application Mobile FitZone)
        $portfolioItems = [
            [
                'titre' => 'Application Mobile FitZone',
                'slug' => 'application-mobile-fitzone',
                'categorie' => 'Web Design',
                'description' => 'Développement d\'une application mobile cross-platform pour une salle de sport connectée. Interface intuitive et suivi des performances en temps réel.',
                'image_url' => 'images/hero-bg.jpg',
                'technologies' => json_encode(['React Native', 'Firebase', 'Redux']),
                'lien_demo' => 'https://fitzone-app.com',
                'lien_github' => 'https://github.com/fitzone/app',
                'featured' => true,
                'actif' => true,
                'ordre' => 1
            ]
        ];

        foreach ($portfolioItems as $item) {
            PortfolioItem::firstOrCreate(['slug' => $item['slug']], $item);
        }

        // TESTIMONIALS - 3 enregistrements
        $testimonials = [
            [
                'nom_client' => 'Marie Dubois',
                'profession' => 'Directrice Marketing, EcoTech Solutions',
                'contenu' => 'L\'équipe ZEEEMAX a complètement transformé notre image de marque. Leur approche stratégique et leur créativité ont permis de repositionner notre entreprise avec succès. Un accompagnement exceptionnel !',
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
                'contenu' => 'Grâce à ZEEEMAX, nous avons dépassé nos objectifs de vente dès le premier trimestre. Leur expertise en marketing digital est remarquable et leur écoute incomparable.',
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
                'contenu' => 'Notre nouveau site web et notre stratégie de communication ont révolutionné notre présence en ligne. Les réservations ont augmenté de 80%. Merci ZEEEMAX !',
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

        // CONTACT MESSAGES - 3 enregistrements
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
            ContactMessage::firstOrCreate(
                ['email' => $message['email'], 'sujet' => $message['sujet']],
                $message
            );
        }

        // PARTNERS - 3 enregistrements
        $partners = [
            [
                'nom' => 'Mme photographe',
                'description' => 'Partenariat en photographie professionnelle et création visuelle.',
                'logo_url' => null,
                'site_web' => null,
                'actif' => true,
                'ordre' => 1
            ],
            [
                'nom' => 'Copie conforme',
                'description' => 'Collaboration sur des projets de reproduction et impression.',
                'logo_url' => null,
                'site_web' => null,
                'actif' => true,
                'ordre' => 2
            ],
            [
                'nom' => 'Graphique enseigne',
                'description' => 'Partenariat pour la création graphique et les enseignes.',
                'logo_url' => null,
                'site_web' => null,
                'actif' => true,
                'ordre' => 3
            ]
        ];

        foreach ($partners as $partner) {
            Partner::firstOrCreate(['nom' => $partner['nom']], $partner);
        }

        // TEAM - 3 enregistrements
        $team = [
            [
                'nom' => 'Marie Martin',
                'poste' => 'Directrice Créative',
                'bio' => 'Spécialiste en identité visuelle et branding, Marie apporte une expertise créative exceptionnelle à chaque projet.',
                'photo_url' => 'images/team/1761670673_6900f611eb948.jpg',
                'reseau_social' => json_encode(['linkedin' => 'https://linkedin.com/in/marie-martin', 'instagram' => 'https://instagram.com/mariemartin']),
                'actif' => true,
                'ordre' => 1
            ],
            [
                'nom' => 'Thomas Durand',
                'poste' => 'Stratège Digital',
                'bio' => 'Expert en stratégie digitale et marketing, Thomas transforme les objectifs business en résultats concrets.',
                'photo_url' => 'images/avatars/1761666022_6900e3e64aeb8.jpeg',
                'reseau_social' => json_encode(['linkedin' => 'https://linkedin.com/in/thomas-durand']),
                'actif' => true,
                'ordre' => 2
            ],
            [
                'nom' => 'Sophie Lambert',
                'poste' => 'Chef de Projet',
                'bio' => 'Sophie coordonne tous les projets avec une approche méthodique et un sens du détail remarquable.',
                'photo_url' => null,
                'reseau_social' => json_encode(['linkedin' => 'https://linkedin.com/in/sophie-lambert']),
                'actif' => true,
                'ordre' => 3
            ]
        ];

        foreach ($team as $member) {
            Team::firstOrCreate(['nom' => $member['nom']], $member);
        }

        // SITE SETTINGS - 3 enregistrements (normalement 1, mais on crée 3 pour tester)
        $siteSettings = [
            [
                'nom_site' => 'ZEEEMAX',
                'logo_url' => 'images/logo-footer.PNG',
                'description_site' => 'ZEEEMAX accompagne les entrepreneurs à révéler leur identité de marque avec un branding sur-mesure et une stratégie digitale impactante.',
                'email' => 'contact@zeeemax.com',
                'telephone' => '+33 1 23 45 67 89',
                'adresse' => '123 Avenue des Champs',
                'ville' => 'Paris',
                'code_postal' => '75008',
                'pays' => 'France',
                'facebook' => 'https://facebook.com/zeeemax',
                'twitter' => 'https://twitter.com/zeeemax',
                'instagram' => 'https://instagram.com/zeeemax',
                'linkedin' => 'https://linkedin.com/company/zeeemax',
                'youtube' => 'https://youtube.com/zeeemax'
            ],
            [
                'nom_site' => 'ZEEEMAX Pro',
                'logo_url' => 'images/logo-white.png',
                'description_site' => 'Version professionnelle de ZEEEMAX pour les grandes entreprises.',
                'email' => 'pro@zeeemax.com',
                'telephone' => '+33 1 23 45 67 90',
                'adresse' => '456 Boulevard Haussmann',
                'ville' => 'Paris',
                'code_postal' => '75009',
                'pays' => 'France',
                'linkedin' => 'https://linkedin.com/company/zeeemax-pro'
            ],
            [
                'nom_site' => 'ZEEEMAX International',
                'logo_url' => 'images/logo-footer.PNG',
                'description_site' => 'ZEEEMAX étend ses services à l\'international.',
                'email' => 'international@zeeemax.com',
                'telephone' => '+33 1 23 45 67 91',
                'pays' => 'France'
            ]
        ];

        foreach ($siteSettings as $setting) {
            if (SiteSetting::where('nom_site', $setting['nom_site'])->doesntExist()) {
                SiteSetting::create($setting);
            }
        }

        // HOMEPAGE SETTINGS - 3 enregistrements
        $homepageSettings = [
            [
                'titre' => 'Révélez votre identité de marque',
                'description' => 'Accompagner les entrepreneurs à construire une image forte et impactante grâce à un branding sur-mesure et une stratégie digitale alignée.',
                'background_type' => 'image',
                'background_image_url' => 'images/hero-bg.jpg',
                'bouton_texte' => 'Découvrir nos services',
                'bouton_url' => '#services'
            ],
            [
                'titre' => 'Transformez votre vision en réalité',
                'description' => 'Des solutions créatives et stratégiques pour faire rayonner votre marque et atteindre vos objectifs business.',
                'background_type' => 'image',
                'background_image_url' => 'images/testimonials-bg.jpg',
                'bouton_texte' => 'Prendre RDV',
                'bouton_url' => '#contact'
            ],
            [
                'titre' => 'L\'expertise au service de votre succès',
                'description' => 'Une équipe passionnée dédiée à votre réussite avec des méthodes éprouvées et des résultats mesurables.',
                'background_type' => 'video',
                'background_video_url' => 'https://youtu.be/example1',
                'bouton_texte' => 'Nous contacter',
                'bouton_url' => '#contact'
            ]
        ];

        foreach ($homepageSettings as $setting) {
            if (HomePageSetting::where('titre', $setting['titre'])->doesntExist()) {
                HomePageSetting::create($setting);
            }
        }

        // APROPOS - 3 enregistrements
        $apropos = [
            [
                'titre' => 'Notre Mission',
                'description' => 'ZEEEMAX est né d\'une envie profonde : aider les entrepreneur(e)s à révéler leur identité, construire une image de marque forte et faire rayonner leur projet avec impact.',
                'image_url' => 'images/md.jpg'
            ],
            [
                'titre' => 'Notre Vision',
                'description' => 'Devenir la référence en branding et stratégie digitale pour les entrepreneurs qui souhaitent transformer leur vision en succès concret.',
                'image_url' => 'images/hero-bg.jpg'
            ],
            [
                'titre' => 'Nos Valeurs',
                'description' => 'Authenticité, créativité, excellence et accompagnement personnalisé sont au cœur de tout ce que nous faisons pour nos clients.',
                'image_url' => null
            ]
        ];

        foreach ($apropos as $item) {
            if (Apropos::where('titre', $item['titre'])->doesntExist()) {
                Apropos::create($item);
            }
        }

        // NEWSLETTERS (Blog Posts) - 3 enregistrements
        $newsletters = [
            [
                'titre' => 'Lancer sa marque: 5 étapes clés',
                'slug' => 'lancer-sa-marque-5-etapes-cles',
                'extrait' => 'De l\'identité au go-to-market, notre méthode condensée pour lancer votre marque avec succès.',
                'categorie' => 'Stratégie',
                'contenu' => "Découvrez les 5 étapes essentielles pour lancer votre marque:\n\n1) Clarifier votre positionnement\n2) Construire votre identité visuelle\n3) Valider votre offre\n4) Déployer vos canaux\n5) Optimiser en continu.\n\nCes étapes vous guideront dans la création d'une marque forte et mémorable.",
                'image_couverture' => 'images/hero-bg.jpg',
                'publie' => true,
                'publie_le' => Carbon::now()->subDays(5)
            ],
            [
                'titre' => 'Booster sa visibilité sur Instagram',
                'slug' => 'booster-sa-visibilite-instagram',
                'extrait' => 'Formats, fréquence, et contenu qui convertit pour maximiser votre présence sur Instagram.',
                'categorie' => 'Marketing Digital',
                'contenu' => "Nous détaillons les formats performants, la fréquence recommandée et des idées de contenus qui engagent durablement. Instagram est un canal puissant pour votre marque si vous suivez les bonnes pratiques.",
                'image_couverture' => 'images/testimonials-bg.jpg',
                'publie' => true,
                'publie_le' => Carbon::now()->subDays(3)
            ],
            [
                'titre' => 'Site web: les erreurs à éviter',
                'slug' => 'site-web-erreurs-a-eviter',
                'extrait' => 'Clarté, vitesse, et conversion: le trio gagnant pour un site web performant.',
                'categorie' => 'Web Design',
                'contenu' => "Votre site doit être clair, rapide et orienté conversion. Voici un check-list simple pour améliorer votre impact et éviter les pièges courants qui font perdre des visiteurs.",
                'image_couverture' => 'images/md.jpg',
                'publie' => true,
                'publie_le' => Carbon::now()->subDays(1)
            ]
        ];

        foreach ($newsletters as $newsletter) {
            Newsletter::firstOrCreate(['slug' => $newsletter['slug']], $newsletter);
        }

        // VALEURS - 3 enregistrements
        $valeurs = [
            [
                'titre' => 'Authenticité',
                'description' => 'Nous croyons en la puissance de l\'authenticité. Chaque marque a une histoire unique à raconter.',
                'icon' => 'heart',
                'couleur' => 'purple',
                'actif' => true,
                'ordre' => 1
            ],
            [
                'titre' => 'Excellence',
                'description' => 'Nous visons l\'excellence dans chaque projet, en alliant créativité et rigueur méthodologique.',
                'icon' => 'star',
                'couleur' => 'blue',
                'actif' => true,
                'ordre' => 2
            ],
            [
                'titre' => 'Innovation',
                'description' => 'Nous restons à la pointe des tendances et des technologies pour vous offrir des solutions modernes.',
                'icon' => 'lightbulb',
                'couleur' => 'green',
                'actif' => true,
                'ordre' => 3
            ]
        ];

        foreach ($valeurs as $valeur) {
            if (Valeur::where('titre', $valeur['titre'])->doesntExist()) {
                Valeur::create($valeur);
            }
        }

        // SUBSCRIBERS - 3 enregistrements
        $subscribers = [
            [
                'email' => 'subscriber1@example.com',
                'prenom' => 'Jean',
                'nom' => 'Dupont',
                'source' => 'site-web',
                'actif' => true
            ],
            [
                'email' => 'subscriber2@example.com',
                'prenom' => 'Marie',
                'nom' => 'Martin',
                'source' => 'reseaux-sociaux',
                'actif' => true
            ],
            [
                'email' => 'subscriber3@example.com',
                'prenom' => 'Pierre',
                'nom' => 'Durand',
                'source' => 'partenaire',
                'actif' => true
            ]
        ];

        foreach ($subscribers as $subscriber) {
            Subscriber::firstOrCreate(['email' => $subscriber['email']], $subscriber);
        }

        // ADMINS - 3 enregistrements
        $admins = [
            [
                'nom' => 'Admin Principal',
                'email' => 'admin@zeeemax.com',
                'password' => Hash::make('password123'),
                'telephone' => '+33 1 23 45 67 89',
                'actif' => true
            ],
            [
                'nom' => 'Admin Secondaire',
                'email' => 'admin2@zeeemax.com',
                'password' => Hash::make('password123'),
                'telephone' => '+33 1 23 45 67 90',
                'actif' => true
            ],
            [
                'nom' => 'Modérateur',
                'email' => 'moderateur@zeeemax.com',
                'password' => Hash::make('password123'),
                'actif' => true
            ]
        ];

        foreach ($admins as $admin) {
            Admin::firstOrCreate(['email' => $admin['email']], $admin);
        }

        // USERS - 3 enregistrements
        $users = [
            [
                'name' => 'Utilisateur Test 1',
                'email' => 'user1@test.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => Carbon::now()
            ],
            [
                'name' => 'Utilisateur Test 2',
                'email' => 'user2@test.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => Carbon::now()
            ],
            [
                'name' => 'Utilisateur Test 3',
                'email' => 'user3@test.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => Carbon::now()
            ]
        ];

        foreach ($users as $user) {
            User::firstOrCreate(['email' => $user['email']], $user);
        }

        // VISITS - 3 enregistrements
        $visits = [
            [
                'ip_address' => '192.168.1.100',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'url' => '/',
                'route_name' => 'home',
                'method' => 'GET',
                'device_type' => 'desktop',
                'browser' => 'Chrome',
                'platform' => 'Windows',
                'country' => 'France',
                'city' => 'Paris',
                'status_code' => 200,
                'response_time' => 150,
                'visited_at' => Carbon::now()->subHours(2)
            ],
            [
                'ip_address' => '192.168.1.101',
                'user_agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_0)',
                'url' => '/services',
                'route_name' => 'services.index',
                'method' => 'GET',
                'device_type' => 'mobile',
                'browser' => 'Safari',
                'platform' => 'iOS',
                'country' => 'France',
                'city' => 'Lyon',
                'status_code' => 200,
                'response_time' => 200,
                'visited_at' => Carbon::now()->subHours(1)
            ],
            [
                'ip_address' => '192.168.1.102',
                'user_agent' => 'Mozilla/5.0 (iPad; CPU OS 15_0)',
                'url' => '/portfolio',
                'route_name' => 'portfolio.index',
                'method' => 'GET',
                'device_type' => 'tablet',
                'browser' => 'Safari',
                'platform' => 'iOS',
                'country' => 'France',
                'city' => 'Marseille',
                'status_code' => 200,
                'response_time' => 180,
                'visited_at' => Carbon::now()->subMinutes(30)
            ]
        ];

        foreach ($visits as $visit) {
            Visit::create($visit);
        }

        $this->command->info('✅ Données de test créées avec succès !');
        $this->command->info('   - 3 Services');
        $this->command->info('   - 1 Portfolio Item');
        $this->command->info('   - 3 Testimonials');
        $this->command->info('   - 3 Contact Messages');
        $this->command->info('   - 3 Partners');
        $this->command->info('   - 3 Team Members');
        $this->command->info('   - 3 Site Settings');
        $this->command->info('   - 3 Homepage Settings');
        $this->command->info('   - 3 Apropos');
        $this->command->info('   - 3 Newsletters');
        $this->command->info('   - 3 Valeurs');
        $this->command->info('   - 3 Subscribers');
        $this->command->info('   - 3 Admins');
        $this->command->info('   - 3 Users');
        $this->command->info('   - 3 Visits');
    }
}

