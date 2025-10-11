<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Add use lines
use App\Events\ChirpCreated;
use App\Listeners\SendChirpCreatedNotifications;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    protected $listen = [
        ChirpCreated::class => [
            SendChirpCreatedNotifications::class,
        ],
        // Other event listeners...
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
