<?php

declare(strict_types=1);

namespace Kossa\AlgerianCities\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

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
        $CreateCitiesTable = include __DIR__.'/../database/migrations/2024_10_26_000000_create_cities_table.php.stub';

        assert($CreateCitiesTable instanceof \Illuminate\Database\Migrations\Migration);

        if (method_exists($CreateCitiesTable, 'up')) {
            $CreateCitiesTable->up();
        }

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
            \Kossa\AlgerianCities\Providers\AlgerianCitiesServiceProvider::class,
        ];
    }
}
