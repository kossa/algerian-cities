<?php
use Kossa\AlgerianCities\Commune;
use Kossa\AlgerianCities\Wilaya;

if (! function_exists('communes')) {
    /**
     * Get commune list
     *
     * @param integer wilaya_id
     * @return array
     */
    function communes(int $wilaya_id = null, bool $withWilaya = false) : array
    {
        $communes = Commune::query();

        if($wilaya_id){
            $communes->where('wilaya_id', $wilaya_id);
        }

        if($withWilaya){
            $communes->withWilaya();
        }
        
        return $communes->pluck('name', 'id')->toArray();
    }
}

if (! function_exists('wilayas')) {
    /**
     * Get commune list
     *
     * @return array
     */
    function wilayas() : array
    {
        return \Kossa\AlgerianCities\wilaya::pluck('name', 'id')->toArray();
    }
}
