<?php

declare(strict_types=1);

namespace Kossa\AlgerianCities\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // Publish verndor
        Artisan::call('vendor:publish', ['--provider' => \Kossa\AlgerianCities\Providers\AlgerianCitiesServiceProvider::class]);

        Artisan::call('db:seed --class=WilayaCommuneSeeder');
    }
}
