<?php
use Kossa\AlgerianCities\Commune;
use Kossa\AlgerianCities\Wilaya;

if (! function_exists('communes')) {
    /**
     * Get communes list
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
     * Get wilayas list
     *
     * @return array
     */
    function wilayas() : array
    {
        return \Kossa\AlgerianCities\wilaya::pluck('name', 'id')->toArray();
    }
}

if (! function_exists('arabic_wilayas')) {
    /**
     * Get wilayas list in arabic
     *
     * @return array
     */
    function arabic_wilayas(): array
    {
        return \Kossa\AlgerianCities\wilaya::pluck('arabic_name', 'id')->toArray();
    }
}
