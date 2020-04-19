<?php
use Kossa\AlgerianCities\Commune;
use Kossa\AlgerianCities\Wilaya;

if (! function_exists('communes')) {

    /**
     * Get list of communes
     *
     * @param integer wilaya_id the id of wilaya
     * @param bool withWilaya if you need to include the wilaya
     * @param string name the default name user arabic_name to get arabic name
     *
     * @return array
     */
    function communes(int $wilaya_id = null, bool $withWilaya = false, $name = "name") : array
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
     * @param string $name default name use arabic_name to get wilayas in arabic
     *
     * @return array
     */
    function wilayas(string $name="name") : array
    {
        return wilaya::pluck($name, 'id')->toArray();
    }
}

if (! function_exists('commune')) {

    /**
     * Get single commune
     *
     * @param integer id The ID of commune
     * @param bool withWilaya True if you need to include wilaya
     * @return array
     */
    function commune(int $id, bool $withWilaya = false)
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
     *
     * @param integer id The ID of wilaya
     *
     * @return array
     */
    function wilaya($id)
    {
        return wilaya::findOrFail($id);
    }
}
