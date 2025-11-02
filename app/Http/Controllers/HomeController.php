<?php

namespace App\Http\Controllers;

use App\Models\HomePageSetting;
use App\Models\Partner;
use App\Models\Client;
use App\Models\PortfolioItem;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageReceived;
use App\Models\Subscriber;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        // Récupérer les services depuis la base de données (max 6 services)
        // S'assurer que "Conception web" et "Application" sont toujours inclus
        $tousLesServices = \App\Models\Service::actif()->ordre()->get();
        
        // Récupérer "Conception web" et "Application" en priorité
        $conceptionWeb = $tousLesServices->where('slug', 'conception-web')->first();
        $application = $tousLesServices->where('slug', 'application')->first();
        
        // Exclure ces deux services du reste
        $autresServices = $tousLesServices->whereNotIn('slug', ['conception-web', 'application']);
        
        // Combiner : Conception web + Application + autres services (jusqu'à 4 autres pour avoir max 6)
        $services = collect();
        
        if ($conceptionWeb) {
            $services->push($conceptionWeb);
        }
        if ($application) {
            $services->push($application);
        }
        
        // Ajouter les autres services jusqu'à avoir 6 au total
        foreach ($autresServices as $service) {
            if ($services->count() >= 6) {
                break;
            }
            $services->push($service);
        }

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

        // Récupérer 3 projets du portfolio (actifs) ordonnés par ordre puis par date
        $portfolioItems = PortfolioItem::actif()
            ->orderBy('ordre')
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        // Récupérer les données dynamiques de l'accueil
        $homepage = HomePageSetting::first();
        
        // Récupérer les paramètres du site pour les infos de contact
        $siteSettings = SiteSetting::first();
        
        // Récupérer les partenaires actifs
        $partners = Partner::where('actif', true)->orderBy('ordre')->get();
        
        // Récupérer les clients actifs
        $clients = Client::where('actif', true)->orderBy('ordre')->get();

        return view('welcome', compact('services', 'testimonials', 'portfolioItems', 'homepage', 'partners', 'siteSettings', 'clients'));
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

        // Envoyer le message par email aux destinataires souhaités
        try {
            $destinataires = [
                'mbayecodou44@gmail.com',
                'contact@zeeemax.com',
            ];
            Mail::to($destinataires)->send(new ContactMessageReceived($validated));
        } catch (\Throwable $e) {
            // On n'interrompt pas l'utilisateur si l'email échoue; journaliser si besoin
            // logger()->error('Erreur envoi email contact: '.$e->getMessage());
        }
        
        // Enregistrer l'email comme abonné (si nouveau)
        try {
            Subscriber::updateOrCreate(
                ['email' => $validated['email']],
                [
                    'prenom' => $validated['first_name'] ?? null,
                    'nom' => $validated['last_name'] ?? null,
                    'source' => 'contact_form',
                    'actif' => true,
                ]
            );
        } catch (\Throwable $e) {
            // ignorer silencieusement si contrainte
        }

        return redirect()->route('contact.index')->with('success', 'Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.');
    }
}

