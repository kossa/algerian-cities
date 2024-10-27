<?php

namespace Kossa\AlgerianCities\Providers;

use Illuminate\Support\ServiceProvider;

class AlgerianCitiesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Migrations
        $this->publishes([
            __DIR__.'/../../database/migrations/2024_10_26_000000_create_cities_table.php.stub' => database_path('migrations').'/2024_10_26_000000_create_cities_table.php',

        ], 'migrations');

        // Seeds
        $this->publishes([
            __DIR__.'/../../database/seeders/' => database_path('seeders'),
        ], 'seeds');

        // Commande
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Kossa\AlgerianCities\Console\Commands\AlgerianCitiesCommand::class,
            ]);
        }

        // API
        $this->loadRoutesFrom(__DIR__.'/../../routes/api.php');

        require __DIR__.'/../helpers.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Config file
         *
         * Uncomment this function call to load the config file.
         * If the config file is also publishable, it will merge with that file
         */
        // $this->mergeConfigFrom(
        //     __DIR__.'/../../config/algerian-cities.php', 'algerian-cities'
        // );
    }
}
