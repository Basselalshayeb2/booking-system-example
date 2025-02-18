<?php

namespace App\Providers;

use App\Http\Interfaces\BookingRepositoryInterface;
use App\Http\Interfaces\ResourceRepositoryInterface;
use App\Http\Repositories\BookingRepository;
use App\Http\Repositories\ResourceRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(
            BookingRepositoryInterface::class,
            BookingRepository::class
        );

        $this->app->bind(
            ResourceRepositoryInterface::class,
            ResourceRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
