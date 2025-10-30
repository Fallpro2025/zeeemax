<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\AproposController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\ValeurController;
use App\Http\Controllers\PublicServiceController;
use App\Http\Controllers\PublicPortfolioController;
use App\Http\Controllers\PublicAproposController;
use App\Http\Controllers\PublicTestimonialController;
use App\Http\Controllers\PublicContactController;
use App\Http\Controllers\PublicTeamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Pages publiques
Route::get('/services', [PublicServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [PublicServiceController::class, 'show'])->name('services.show');
Route::get('/portfolio', [PublicPortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{slug}', [PublicPortfolioController::class, 'show'])->name('portfolio.show');
Route::get('/a-propos', [PublicAproposController::class, 'index'])->name('apropos.index');
Route::get('/temoignages', [PublicTestimonialController::class, 'index'])->name('testimonials.index');
Route::get('/equipe', [PublicTeamController::class, 'index'])->name('team.index');
Route::get('/contact', [PublicContactController::class, 'index'])->name('contact.index');

// Contact (formulaire)
Route::post('/contact', [HomeController::class, 'storeContact'])->name('contact.store');

// Routes Admin (cachées - pas de liens sur le site)
Route::get('/admin-panel-access', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin-panel-access', [AdminController::class, 'login'])->name('admin.login.submit');
Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin-logout', [AdminController::class, 'logout'])->name('admin.logout');

// Routes Admin CRUD (protégées par middleware dans les contrôleurs)
Route::prefix('admin')->name('admin.')->group(function () {
    // Gestion des Services
    Route::resource('services', ServiceController::class);
    Route::post('services/{service}/toggle', [ServiceController::class, 'toggle'])->name('services.toggle');
    
    // Gestion du Portfolio
    Route::resource('portfolio', PortfolioController::class);
    Route::post('portfolio/{portfolioItem}/toggle', [PortfolioController::class, 'toggle'])->name('portfolio.toggle');
    
    // Gestion des Témoignages
    Route::resource('testimonials', TestimonialController::class);
    Route::post('testimonials/{testimonial}/toggle', [TestimonialController::class, 'toggle'])->name('testimonials.toggle');
    
    // Gestion des Messages de Contact
    Route::resource('contacts', ContactController::class)->except(['create', 'store', 'edit', 'update']);
    Route::post('contacts/{contact}/mark-read', [ContactController::class, 'markAsRead'])->name('contacts.mark-read');
    Route::post('contacts/{contact}/archive', [ContactController::class, 'archive'])->name('contacts.archive');
    Route::post('contacts/{contact}/notes', [ContactController::class, 'updateNotes'])->name('contacts.notes');
    Route::post('contacts/mark-all-read', [ContactController::class, 'markAllAsRead'])->name('contacts.mark-all-read');
    Route::post('contacts/archive-selected', [ContactController::class, 'archiveSelected'])->name('contacts.archive-selected');
    
    // Gestion de l'Équipe
    Route::resource('team', TeamController::class);
    Route::post('team/{team}/toggle', [TeamController::class, 'toggle'])->name('team.toggle');
    
    // Gestion des Partenaires
    Route::resource('partners', PartnerController::class);
    Route::post('partners/{partner}/toggle', [PartnerController::class, 'toggle'])->name('partners.toggle');
    
    // Gestion "À propos"
    Route::resource('apropos', AproposController::class);
    
    // Gestion des Valeurs
    Route::resource('valeurs', ValeurController::class);
    Route::post('valeurs/{valeur}/toggle', [ValeurController::class, 'toggle'])->name('valeurs.toggle');
    
    // Paramétrage du site
    Route::get('site-settings', [SiteSettingController::class, 'index'])->name('site-settings.index');
    Route::put('site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');
    
    // Gestion des administrateurs
    Route::resource('admins', AdminUserController::class);
    Route::post('admins/{admin}/toggle', [AdminUserController::class, 'toggle'])->name('admins.toggle');
    
    // Profil administrateur
    Route::get('profile', [AdminProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [AdminProfileController::class, 'update'])->name('profile.update');
    
    // Gestion de l'accueil
    Route::get('homepage', [HomePageController::class, 'index'])->name('homepage.index');
    Route::put('homepage', [HomePageController::class, 'update'])->name('homepage.update');
});

// Routes futures (à décommenter quand les contrôleurs seront créés)
// Route::get('/services', [ServiceController::class, 'index'])->name('services');
// Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
// Route::get('/about', [AboutController::class, 'index'])->name('about');
// Route::get('/blog', [BlogController::class, 'index'])->name('blog');
// Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
