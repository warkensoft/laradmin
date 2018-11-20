<?php

namespace Warkensoft\Laradmin;

use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    $this->publishes([
		    __DIR__.'/laradmin.php' => config_path('laradmin.php')
	    ], 'config');
	    $this->publishes([
		    __DIR__.'/Resources/Views' => resource_path('views/vendor/laradmin'),
	    ], 'views');
	    $this->publishes([
		    __DIR__.'/Resources/Lang' => resource_path('lang/vendor/laradmin'),
	    ], 'translations');

	    $this->publishes([
		    __DIR__.'/Resources/Assets' => public_path('vendor/laradmin'),
	    ], 'public');

	    $this->loadRoutesFrom(__DIR__.'/routes.php');
	    $this->loadMigrationsFrom(__DIR__.'/Migrations');
	    $this->loadTranslationsFrom(__DIR__.'/Resources/Lang', 'laradmin');
	    $this->loadViewsFrom(__DIR__.'/Resources/Views', 'laradmin');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
	    $this->mergeConfigFrom(
		    __DIR__.'/laradmin.php', 'laradmin'
	    );
    }
}
