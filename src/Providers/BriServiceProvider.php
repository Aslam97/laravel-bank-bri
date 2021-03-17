<?php

namespace Aslam\Bri\Providers;

use Illuminate\Support\ServiceProvider;

class BriServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/bank-bri.php' => config_path('bank-bri.php'),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('BriAPI', function () {
            return new \Aslam\Bri\Bri();
        });

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/bank-bri.php',
            'bank-bri'
        );
    }
}