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
        Artisan::call('vendor:publish' ,["--provider"=>"Kossa\AlgerianCities\Providers\AlgerianCitiesServiceProvider"]);
        
        
        // Check if table exist
        if(! Schema::hasTable('wilayas') || ! Schema::hasTable('communes')){
            if($this->confirm('Wilayas/Communes tables does not exist, Do you want to run migration', true)){
                Artisan::call('migrate');
            }else{
                return;
            }
        }

        $wilayas = DB::table('wilayas')->count();
        $communes = DB::table('communes')->count();

        if(!$wilayas && !$communes){
            $this->loadData();
            $this->info("Success!! wilayas and communes are loaded successfully");
            return;
        }
        
        $this->info("Wilayas/Communes already loaded");
    }

    protected function loadData(){
        DB::unprepared(file_get_contents(database_path('seeds/sql/wilayas.sql')));
        DB::unprepared(file_get_contents(database_path('seeds/sql/communes.sql')));
    }
}
