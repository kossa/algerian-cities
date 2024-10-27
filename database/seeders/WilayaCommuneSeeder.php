<?php

namespace Database\Seeders;

use ErrorException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class WilayaCommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if table exist
        if (! Schema::hasTable('wilayas') || ! Schema::hasTable('communes')) {
            Artisan::call('migrate');
        }

        $wilayas = DB::table('wilayas')->count();
        $communes = DB::table('communes')->count();

        if (! $wilayas && ! $communes) {
            $this->loadData();
            $this->command->info('Success!! wilayas and communes are loaded successfully');

            return;
        }

        $this->command->comment('Wilayas/Communes already loaded');
    }

    protected function loadData()
    {
        $this->insertWilayas();
        $this->insertCommunes();
    }

    protected function insertWilayas()
    {
        // Load wilayas from json
        try {
            $wilayas_json = json_decode(file_get_contents(database_path('/seeders/json/Wilaya_Of_Algeria.json')));
        } catch (ErrorException $e) {
            $wilayas_json = json_decode(file_get_contents(__DIR__.'/json/Wilaya_Of_Algeria.json'));
        }
        // Insert Wilayas
        $data = [];
        foreach ($wilayas_json as $wilaya) {
            $data[] = [
                'name' => $wilaya->name,
                'arabic_name' => $wilaya->ar_name,
                'longitude' => $wilaya->longitude,
                'latitude' => $wilaya->latitude,
                'created_at' => now(),
            ];
        }
        DB::table('wilayas')->insert($data);
    }

    protected function insertCommunes()
    {
        // Load wilayas from json
        try {
            $communes_json = json_decode(file_get_contents(database_path('/seeders/json/Commune_Of_Algeria.json')));
        } catch (ErrorException $e) {
            $communes_json = json_decode(file_get_contents(__DIR__.'/json/Commune_Of_Algeria.json'));
        }
        // Insert communes
        $data = [];
        foreach ($communes_json as $commune) {
            $data[] = [
                'name' => $commune->name,
                'arabic_name' => $commune->ar_name,
                'post_code' => $commune->post_code,
                'wilaya_id' => $commune->wilaya_id,
                'longitude' => $commune->longitude,
                'latitude' => $commune->latitude,
                'created_at' => now(),
            ];
        }
        DB::table('communes')->insert($data);
    }
}
