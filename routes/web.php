<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactController;
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

// Contact
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
});

// Routes futures (à décommenter quand les contrôleurs seront créés)
// Route::get('/services', [ServiceController::class, 'index'])->name('services');
// Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
// Route::get('/about', [AboutController::class, 'index'])->name('about');
// Route::get('/blog', [BlogController::class, 'index'])->name('blog');
// Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
