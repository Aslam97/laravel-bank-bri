<?php

namespace Aslam\Bri\Providers;

use Aslam\Bri\Bri;
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
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/../../config/bank-bri.php' => config_path('bank-bri.php'),
            ]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/bank-bri.php', 'bank-bri');

        $this->app->singleton('BriAPI', function () {
            return new Bri();
        });
    }
}
