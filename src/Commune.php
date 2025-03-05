<?php

declare(strict_types=1);

namespace Kossa\AlgerianCities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

/**
 * @property Wilaya $wilaya
 */
class Commune extends Model
{
    protected $fillable = ['name', 'arabic_name', 'post_code', 'wilaya_id', 'longitude', 'latitude'];

    /**
     * Validation rules
     *
     * @return array<string, string>
     */
    public static function rules(): array
    {
        return [
            'name' => 'required',
            'wilaya_id' => 'required|numeric',
        ];
    }

    /**
     * @param  Builder<Wilaya>  $query
     */
    public function scopeWithWilaya(Builder $query, string $name = 'name'): void
    {
        $query->leftJoin('wilayas', 'wilayas.id', 'communes.wilaya_id')
            ->select('communes.id', DB::raw(sprintf("concat(communes.%s, ', ', wilayas.%s) as name", $name, $name)));
    }

    /**
     * @return BelongsTo<Wilaya, $this>
     */
    public function wilaya(): BelongsTo
    {
        return $this->belongsTo(Wilaya::class)->withDefault();
    }

    /*
    |------------------------------------------------------------------------------------
    | Attribute
    |------------------------------------------------------------------------------------
    */
    public function getWilayaNameAttribute(): string
    {
        return $this->wilaya->name;
    }
}
