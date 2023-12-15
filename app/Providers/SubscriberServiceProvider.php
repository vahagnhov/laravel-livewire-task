<?php

namespace App\Providers;

use App\Repositories\Interfaces\SubscriberRepositoryInterface;
use App\Repositories\SubscriberRepository;
use Illuminate\Support\ServiceProvider;

class SubscriberServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            SubscriberRepositoryInterface::class,
            SubscriberRepository::class
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
