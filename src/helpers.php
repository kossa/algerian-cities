<?php

declare(strict_types=1);

use Kossa\AlgerianCities\Models\Commune;
use Kossa\AlgerianCities\Models\Wilaya;

if (! function_exists('communes')) {

    /**
     * Get list of communes
     *
     * @return array<mixed>
     */
    function communes(?int $wilaya_id = null, bool $withWilaya = false, string $name = 'name'): array
    {
        $communes = Commune::query();

        if ($wilaya_id) {
            $communes->where('wilaya_id', $wilaya_id);
        }

        if ($withWilaya) {
            $communes->withWilaya($name);
        }

        return $communes->pluck('name', 'id')->toArray();
    }
}

if (! function_exists('wilayas')) {

    /**
     * Get list of wilayas
     *
     * @return array<mixed>
     */
    function wilayas(string $name = 'name'): array
    {
        return wilaya::pluck($name, 'id')->toArray();
    }
}

if (! function_exists('commune')) {

    /**
     * Get single commune
     */
    function commune(int $id, bool $withWilaya = false): Commune
    {
        $commune = Commune::findOrFail($id);

        if ($withWilaya) {
            $commune->load('wilaya');
        }

        return $commune;
    }
}

if (! function_exists('wilaya')) {

    /**
     * Get single wilaya
     **/
    function wilaya(int $id): Wilaya
    {
        return wilaya::findOrFail($id);
    }
}
