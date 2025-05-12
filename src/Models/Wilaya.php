<?php

declare(strict_types=1);

namespace Kossa\AlgerianCities\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kossa\AlgerianCities\Database\Factories\WilayaFactory;
use Kossa\AlgerianCities\Traits\HasCommune;

/**
 * @property string $name
 */
class Wilaya extends Model
{
    use HasCommune;

    /** @use HasFactory<WilayaFactory> */
    use HasFactory;

    protected $fillable = ['name', 'arabic_name', 'longitude', 'latitude'];

    /**
     * Validation rules
     *
     * @return array<string, string>
     */
    public static function rules(): array
    {
        return [
            'name' => 'required',
        ];
    }

    /**
     * @return HasMany<Commune, $this>
     */
    public function communes(): HasMany
    {
        return $this->hasMany(Commune::class);
    }

    protected static function newFactory(): WilayaFactory
    {
        return WilayaFactory::new();
    }
}
