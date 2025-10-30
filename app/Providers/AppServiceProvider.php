<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Models\SiteSetting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Configuration de Carbon pour les dates en français
        Carbon::setLocale('fr');

        // Partager les paramètres du site avec toutes les vues
        try {
            $siteSettings = cache()->remember('site_settings_first', 60, function () {
                return SiteSetting::first();
            });
        } catch (\Throwable $e) {
            $siteSettings = null;
        }
        View::share('siteSettings', $siteSettings);
    }
}
