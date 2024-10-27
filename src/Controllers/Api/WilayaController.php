<?php

namespace Kossa\AlgerianCities\Controllers\Api;

use Kossa\AlgerianCities\Commune;
use Kossa\AlgerianCities\Wilaya;

class WilayaController
{
    /**
     * Get all wilayas.
     */
    public function index()
    {
        return Wilaya::all();
    }

    /**
     * Get a specified Wilaya.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        return Wilaya::findOrFail($id);
    }

    /**
     * Get communes of wilayas_id.
     *
     * @param  int  $id
     */
    public function communes($id)
    {
        return Commune::where('wilaya_id', $id)->get();
    }

    /**
     * Search wilaya by name or arabic_name
     *
     * @param  string  $q
     */
    public function search($q)
    {
        return Wilaya::where('name', 'like', "%$q%")
            ->orWhere('arabic_name', 'like', "%$q%")
            ->get();
    }
}
