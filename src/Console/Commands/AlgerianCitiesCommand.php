<?php

namespace Kossa\AlgerianCities\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Schema;
use Artisan;

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
     *
     * @return mixed
     */
    public function handle()
    {
        // Publish verndor
        Artisan::call('vendor:publish', ["--provider"=>"Kossa\AlgerianCities\Providers\AlgerianCitiesServiceProvider"]);
        
        
        // Check if table exist
        if (! Schema::hasTable('wilayas') || ! Schema::hasTable('communes')) {
            if ($this->confirm('Wilayas/Communes tables does not exist, Do you want to run migration', true)) {
                Artisan::call('migrate');
            } else {
                return;
            }
        }

        $wilayas = DB::table('wilayas')->count();
        $communes = DB::table('communes')->count();

        if (!$wilayas && !$communes) {
            $this->loadData();
            $this->info("Success!! wilayas and communes are loaded successfully");
            return;
        }
        
        $this->comment("Wilayas/Communes already loaded");
    }

    protected function loadData()
    {
        $this->insertWilayas();
        $this->insertCommunes();
    }

    protected function insertWilayas()
    {
        // Load wilayas from json
        $wilayas_json = json_decode(file_get_contents(database_path('seeds/json/Wilaya_Of_Algeria.json')));

        // Insert Wilayas
        $data = [];
        foreach ($wilayas_json as $wilaya) {
            $data[] = [
                'id'          => $wilaya->id,
                'name'        => $wilaya->name,
                'arabic_name' => $wilaya->ar_name,
                'longitude'   => $wilaya->longitude,
                'latitude'    => $wilaya->latitude,
                'created_at'  => now(),
            ];
        }
        DB::table('wilayas')->insert($data);
    }

    protected function insertCommunes()
    {
        // Load wilayas from json
        $communes_json = json_decode(file_get_contents(database_path('seeds/json/Commune_Of_Algeria.json')));

        // Insert communes
        $data = [];
        foreach ($communes_json as $commune) {
            $data[] = [
                'id'          => $commune->id,
                'name'        => $commune->name,
                'arabic_name' => $commune->ar_name,
                'post_code'   => $commune->post_code,
                'wilaya_id'   => $commune->wilaya_id,
                'longitude'   => $commune->longitude,
                'latitude'    => $commune->latitude,
                'created_at'  => now(),
            ];
        }
        DB::table('communes')->insert($data);
    }
}
