<?php

namespace App\Providers;

use App\Interfaces\EquipoInterface;
use App\Interfaces\PrestamoInterface;
use App\Repositories\EquipoRepository;
use App\Repositories\PrestamoRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PrestamoInterface::class, PrestamoRepository::class);
        $this->app->bind(EquipoInterface::class, EquipoRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}
}
