<?php

namespace App\Providers;

use LinkedIn\LinkedIn;
use Illuminate\Support\ServiceProvider;


class LinkedInServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(LinkedIn::class, function ($app) {
            $config = config('services.facebook');
            return new LinkedIn([
                'app_id' => $config['client_id'],
                'app_secret' => $config['client_secret'],
                'default_graph_version' => 'v2.6',
            ]);
        });
    }
}
