<?php

namespace App\Http\Controllers;

use App\Models\HomePageSetting;
use App\Models\Partner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        // Données temporaires pour les services
        $services = collect([
            (object)[
                'id' => 1,
                'title' => 'Branding sur-mesure',
                'slug' => 'branding',
                'description' => 'Révélez votre identité unique avec un branding aligné à vos valeurs. Logo, charte graphique, identité visuelle complète qui vous ressemble.',
                'icon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>'
            ],
            (object)[
                'id' => 2,
                'title' => 'Communication alignée',
                'slug' => 'communication',
                'description' => 'Structurez votre communication pour toucher votre audience avec des messages percutants et cohérents qui reflètent votre essence.',
                'icon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>'
            ],
            (object)[
                'id' => 3,
                'title' => 'Stratégie digitale',
                'slug' => 'strategie-digitale',
                'description' => 'Développez votre visibilité en ligne avec une stratégie digitale impactante et des outils performants pour atteindre vos objectifs.',
                'icon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>'
            ]
        ]);

        // Données temporaires pour les témoignages
        $testimonials = collect([
            (object)[
                'id' => 1,
                'name' => 'Coumba',
                'profession' => 'Influenceuse',
                'content' => 'Kadia a fait du bon boulot. Je suis passée de 34.000 abonnés à 45.000 abonnés en juste un mois. Je me concentre mieux sur mon activité et elle s\'occupe de ma présence en ligne.',
                'metric' => '+32% d\'abonnés',
                'avatar' => null
            ],
            (object)[
                'id' => 2,
                'name' => 'Rama',
                'profession' => 'Entrepreneure',
                'content' => 'J\'ai adoré la création de contenu. C\'est nickel! Simple, clair et concis. Les couleurs répondent au logo.',
                'metric' => 'Branding parfait',
                'avatar' => null
            ],
            (object)[
                'id' => 3,
                'name' => 'Khady',
                'profession' => 'Coach',
                'content' => 'J\'étais trop stressée sur comment avoir des clients sur Instagram mais woow tu m\'as redonné confiance en moi et ma page instagram s\'est transformée comme par magie !',
                'metric' => '+180% d\'engagement',
                'avatar' => null
            ],
            (object)[
                'id' => 4,
                'name' => 'Aïda',
                'profession' => 'Marque de mode',
                'content' => 'Franchement j\'aimerai te remercier pour cette qualité de service que tu offres à tes clients et aussi ta disponibilité. Juste 1 mois et j\'ai remarqué une nette amélioration de ma page.',
                'metric' => 'Résultats en 1 mois',
                'avatar' => null
            ],
            (object)[
                'id' => 5,
                'name' => 'Yolene',
                'profession' => 'Créatrice de contenu',
                'content' => 'J\'ai reçu beaucoup de retours positifs du contenu que vous avez créé. Je tiens vraiment à vous féliciter. Je suis très satisfaite du résultat de notre collaboration.',
                'metric' => '100% satisfaite',
                'avatar' => null
            ],
            (object)[
                'id' => 6,
                'name' => 'Coumba',
                'profession' => 'Influenceuse beauté',
                'content' => 'La page est dynamique, les gens interagissent beaucoup, le nombre de follower n\'arrête pas de grimper. Et j\'ai jamais eu autant de vues pour les réels.',
                'metric' => 'Record de vues',
                'avatar' => null
            ]
        ]);

        // Données temporaires pour les éléments du portfolio
        $portfolioItems = collect([
            (object)[
                'id' => 1,
                'title' => 'Refonte de marque',
                'category' => 'Branding',
                'description' => 'Création d\'une identité visuelle moderne et percutante pour une startup.',
                'image' => 'https://picsum.photos/seed/branding/600/400' // Image en ligne pour Portfolio 1
            ],
            (object)[
                'id' => 2,
                'title' => 'Campagne digitale',
                'category' => 'Stratégie Digitale',
                'description' => 'Mise en place d\'une campagne marketing sur les réseaux sociaux avec des résultats exceptionnels.',
                'image' => 'https://picsum.photos/seed/digital/600/400' // Image en ligne pour Portfolio 2
            ],
            (object)[
                'id' => 3,
                'title' => 'Site E-commerce',
                'category' => 'Développement Web',
                'description' => 'Conception et développement d\'une plateforme e-commerce intuitive et performante.',
                'image' => 'https://picsum.photos/seed/ecommerce/600/400' // Image en ligne pour Portfolio 3
            ],
            (object)[
                'id' => 4,
                'title' => 'Contenu vidéo',
                'category' => 'Communication',
                'description' => 'Production de vidéos engageantes pour promouvoir les services d\'un coach en ligne.',
                'image' => 'https://picsum.photos/seed/video/600/400' // Image en ligne pour Portfolio 4
            ]
        ]);

        // Récupérer les données dynamiques de l'accueil
        $homepage = HomePageSetting::first();
        
        // Récupérer les partenaires actifs
        $partners = Partner::where('actif', true)->orderBy('ordre')->get();

        return view('welcome', compact('services', 'testimonials', 'portfolioItems', 'homepage', 'partners'));
    }

    /**
     * Store a contact form submission.
     */
    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Sauvegarder le message en base de données
        \App\Models\ContactMessage::create([
            'prenom' => $validated['first_name'],
            'nom' => $validated['last_name'],
            'email' => $validated['email'],
            'sujet' => $validated['subject'],
            'message' => $validated['message'],
            'statut' => 'nouveau'
        ]);
        
        return redirect()->route('contact.index')->with('success', 'Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.');
    }
}

