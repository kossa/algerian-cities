<?php

declare(strict_types=1);

namespace Kossa\AlgerianCities\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Kossa\AlgerianCities\AlgerianCitiesServiceProvider;

class AlgerianCitiesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'algerian-cities:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload wilayas/communes';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {

        Artisan::call('vendor:publish', ['--provider' => AlgerianCitiesServiceProvider::class]);

        Artisan::call('db:seed --class=WilayaCommuneSeeder');

        $this->info('Success!! wilayas and communes are loaded successfully');

        // return laravel command success
        return self::SUCCESS;
    }
}
