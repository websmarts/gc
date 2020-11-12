<?php

namespace App\Providers;

use Hashids\Hashids;
use Illuminate\Support\ServiceProvider;

class HasherServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        
        
        $this->mergeConfigFrom(config_path('hasher.php'), 'hasher');
        $this->registerHasher();
    }

    private function registerHasher()
    {
        $this->app->bind('hasher', function ($app) {
            /** @var \Illuminate\Config\Repository $config */
            $config = $app['config'];
            
            return new Hashids(
                $config->get('hasher.salt'),
                $config->get('hasher.length'),
                $config->get('hasher.alphabet')
            );
        });
    }
}