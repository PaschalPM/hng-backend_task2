<?php

namespace App\Providers;

use App\Http\Resources\PersonResource;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;

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
    public function boot(UrlGenerator $url): void
    {
        PersonResource::withoutWrapping();
        if (env('APP_ENV') == 'production') {
            $url->forceScheme('https');
        }
    }
}
