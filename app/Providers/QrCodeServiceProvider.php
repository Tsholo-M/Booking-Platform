<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        QrCode::setBackend('gd');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
