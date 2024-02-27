<?php

namespace App\Providers;

use App\Http\Resources\RidersResource;
use App\Http\Resources\UsuarioResource;
use Illuminate\Pagination\Paginator;
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
    public function boot(): void
    {
        Paginator::useBootstrap();
        UsuarioResource::withoutWrapping();
        RidersResource::withoutWrapping();

    }
}
