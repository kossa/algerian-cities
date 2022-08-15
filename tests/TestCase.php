<?php

namespace Kossa\AlgerianCities\Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Override the standard PHPUnit testcase with the Testbench testcase
 *
 * @see https://github.com/orchestral/testbench#usage
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    public function getEnvironmentSetUp($app)
    {
        // include_once __DIR__ . '/../database/migrations/create_cities_table.php.stub';

        // // run the migration's up() method
        // (new \CreateCitiesTable)->up(); 
        Artisan::call('migrate:fresh');    
        Artisan::call('db:seed', ['--class' => 'WilayaCommuneSeeder']);
    }

    /**
     * Include the package's service provider(s)
     *
     * @see https://packages.tools/testbench/basic/testcase.html#package-service-providers
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Kossa\AlgerianCities\Providers\AlgerianCitiesServiceProvider::class
        ];
    }
}
