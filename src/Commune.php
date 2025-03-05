<?php

declare(strict_types=1);

namespace Kossa\AlgerianCities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property Wilaya $wilaya
 */
class Commune extends Model
{
    protected $fillable = ['name', 'arabic_name', 'post_code', 'wilaya_id', 'longitude', 'latitude'];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null): array
    {
        return [
            'name' => 'required',
            'wilaya_id' => 'required|numeric',
        ];
    }

    /*
    |------------------------------------------------------------------------------------
    | Relations
    |------------------------------------------------------------------------------------
    */
    public function scopeWithWilaya($q, $name = 'name'): void
    {
        $q->leftJoin('wilayas', 'wilayas.id', 'communes.wilaya_id')
            ->select('communes.id', DB::raw(sprintf("concat(communes.%s, ', ', wilayas.%s) as name", $name, $name)));
    }

    public function wilaya()
    {
        return $this->belongsTo(Wilaya::class)->withDefault();
    }

    /*
    |------------------------------------------------------------------------------------
    | Attribute
    |------------------------------------------------------------------------------------
    */
    public function getWilayaNameAttribute()
    {
        return $this->wilaya->name;
    }
}
