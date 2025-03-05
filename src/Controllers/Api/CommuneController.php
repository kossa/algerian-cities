<?php

declare(strict_types=1);

namespace Kossa\AlgerianCities\Controllers\Api;

use Illuminate\Database\Eloquent\Collection;
use Kossa\AlgerianCities\Commune;

class CommuneController
{
    /**
     * Get all Communes.
     *
     * @return Collection<int, Commune>
     */
    public function index(): Collection
    {
        return Commune::all();
    }

    /**
     * Get a specified Commune.
     */
    public function show(int $id): Commune
    {
        return Commune::findOrFail($id);
    }

    /**
     * Search wilaya by name or arabic_name
     *
     * @param  string  $q
     * @return Collection<int, Commune>
     */
    public function search($q): Collection
    {
        return Commune::where('name', 'like', sprintf('%%%s%%', $q))
            ->orWhere('arabic_name', 'like', sprintf('%%%s%%', $q))
            ->get();
    }
}
