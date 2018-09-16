<?php

namespace Newbiecoder99\Uptube;

use Illuminate\Support\ServiceProvider;

class UptubeServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $config = realpath(__DIR__.'/../config/uptube.php');

        $this->publishes([$config => config_path('uptube.php')], 'config');

        $this->mergeConfigFrom($config, 'uptube');

        $this->publishes([
            __DIR__.'/../migrations/' => database_path('migrations')
        ], 'migrations');

        if($this->app->config->get('uptube.routes.enabled')) {
            include __DIR__.'/../routes/web.php';
        }
    }

    /**
    * Register the service provider.
    */
    public function register()
    {
        $this->app->singleton('uptube', function($app) {
            return new Uptube($app, new \Google_Client);
        });
    }
}