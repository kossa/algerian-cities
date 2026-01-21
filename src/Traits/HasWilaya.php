<?php

declare(strict_types=1);

namespace Kossa\AlgerianCities\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kossa\AlgerianCities\Models\Wilaya;

trait HasWilaya
{
    /**
     * @return BelongsTo<Wilaya, $this>
     */
    public function wilaya(): BelongsTo
    {
        return $this->belongsTo(Wilaya::class);
    }
}
