<?php

declare(strict_types=1);

namespace Kossa\AlgerianCities;

use Database\Seeders\WilayaCommuneSeeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AlgerianCitiesServiceProvider extends PackageServiceProvider
{
    // require __DIR__.'/helpers.php';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */

        $package
            ->name('algerian-cities')
            ->hasConfigFile()
            ->hasRoutes('api')
            ->hasMigration('create_wilayas_table')
            ->hasMigration('create_communes_table')
            ->hasInstallCommand(function (InstallCommand $command): void {

                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->endWith(fn () => Artisan::call('db:seed', ['--class' => WilayaCommuneSeeder::class]))
                    ->askToStarRepoOnGitHub('kossa/algerian-cities');
            });

    }
}
