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

    // /**
    //  * Merge the given configuration with the existing configuration.
    //  *
    //  * @param  string  $path
    //  * @param  string  $key
    //  * @return void
    //  */
    // protected function mergeConfigFrom($path, $key)
    // {
    //     $config = $this->app['config']->get($key, []);

    //     $mg = $this->mergeConfig(require $path, $config);

    //     $this->app['config']->set($key, $mg);
    // }

    // /**
    //  * Merges the configs together and takes multi-dimensional arrays into account.
    //  *
    //  * @param  array  $original
    //  * @param  array  $merging
    //  * @return array
    //  */
    // protected function mergeConfig(array $original, array $merging)
    // {
    //     // dd($original, $merging);
    //     $array = array_merge($original, $merging);

    //     foreach ($original as $key => $value) {
    //         if (!is_array($value)) {
    //             continue;
    //         }

    //         if (!Arr::exists($merging, $key)) {
    //             continue;
    //         }

    //         if (is_numeric($key)) {
    //             continue;
    //         }

    //         $array[$key] = $this->mergeConfig($value, $merging[$key]);
    //     }
    //     return $array;
    // }
}
