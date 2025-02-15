<?php

namespace App\Providers;

use App\Models\Booking;
use App\Observers\BookingObserver;
use App\Repositories\BookingRepository;
use App\Services\BookingService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BookingService::class, function ($app) {
            return new BookingService(new BookingRepository());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Booking::observe(BookingObserver::class);
    }
}
