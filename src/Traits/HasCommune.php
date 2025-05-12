<?php

declare(strict_types=1);

namespace Kossa\AlgerianCities\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kossa\AlgerianCities\Models\Commune;

trait HasCommune
{
    /**
     * Get the associated Commune (one-to-one, foreign key is on this model).
     *
     * @return BelongsTo<Commune, $this>
     */
    public function commune(): BelongsTo
    {
        return $this->belongsTo(Commune::class);
    }
}
