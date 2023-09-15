<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\V1\Files\Services\Contracts\UploadInterface;
use Modules\V1\Files\Services\Drivers\Local\UploadToLocal;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UploadInterface::class, static function() {
            return new UploadToLocal();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
