<?php

declare(strict_types=1);

namespace Kossa\AlgerianCities\Models;

use Database\Factories\CommuneFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kossa\AlgerianCities\Traits\HasWilaya;

/**
 * @property Wilaya $wilaya
 */
class Commune extends Model
{
    /** @use HasFactory<CommuneFactory> */
    use HasFactory;

    use HasWilaya;

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

    /*
    |------------------------------------------------------------------------------------
    | Attribute
    |------------------------------------------------------------------------------------
    */
    public function getWilayaNameAttribute(): string
    {
        return $this->wilaya->name;
    }

    protected static function newFactory(): CommuneFactory
    {
        return CommuneFactory::new();
    }
}
