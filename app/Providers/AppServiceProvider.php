<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use App\Models\Campaign;
use App\Policies\CampaignPolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;


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
        Paginator::useBootstrap(); 
        Carbon::setLocale('id');
        Gate::policy(Campaign::class, CampaignPolicy::class);

            if (app()->environment('local')) {
        URL::forceRootUrl(config('app.url')); // agar asset mengarah ke ngrok
        URL::forceScheme('https');            // agar https, bukan http
    }

}
}