<?php

declare(strict_types=1);

namespace Kossa\AlgerianCities\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Kossa\AlgerianCities\AlgerianCitiesServiceProvider;
use Spatie\LaravelPackageTools\Package;

/**
 * Override the standard PHPUnit testcase with the Testbench testcase
 *
 * @see https://github.com/orchestral/testbench#usage
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    protected function getEnvironmentSetUp($app): void
    {

        $createWilayasTable = include __DIR__.'/../database/migrations/create_wilayas_table.php';
        $createCommunesTable = include __DIR__.'/../database/migrations/create_communes_table.php';

        $createWilayasTable->up();
        $createCommunesTable->up();

        Artisan::call('db:seed', ['--class' => 'WilayaCommuneSeeder']);
    }

    /**
     * Include the package's service provider(s)
     **
     * @param  Application  $app
     */
    protected function getPackageProviders($app): array
    {
        return [
            AlgerianCitiesServiceProvider::class,
        ];
    }
}
