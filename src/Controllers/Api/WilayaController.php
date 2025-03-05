<?php

declare(strict_types=1);

namespace Kossa\AlgerianCities\Controllers\Api;

use Illuminate\Database\Eloquent\Collection;
use Kossa\AlgerianCities\Commune;
use Kossa\AlgerianCities\Wilaya;

class WilayaController
{
    /**
     * Get all wilayas.
     *
     * @return Collection<int, Wilaya>
     */
    public function index(): Collection
    {
        return Wilaya::all();
    }

    /**
     * Get a specified Wilaya.
     */
    public function show(int $id): Wilaya
    {
        return Wilaya::findOrFail($id);
    }

    /**
     * Get communes of wilayas_id.
     *
     * @return Collection<int, Commune>
     */
    public function communes(int $id): Collection
    {
        return Commune::where('wilaya_id', $id)->get();
    }

    /**
     * Search wilaya by name or arabic_name
     *
     * @return Collection<int, Wilaya>
     */
    public function search(string $keyword): Collection
    {
        return Wilaya::where('name', 'like', sprintf('%%%s%%', $keyword))
            ->orWhere('arabic_name', 'like', sprintf('%%%s%%', $keyword))
            ->get();
    }
}
