<?php

namespace Kossa\AlgerianCities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 */
class Wilaya extends Model
{
    protected $fillable = ['name', 'arabic_name', 'longitude', 'latitude'];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        return [
            'name' => 'required',
        ];
    }

    /*
    |------------------------------------------------------------------------------------
    | Relations
    |------------------------------------------------------------------------------------
    */
    public function communes()
    {
        return $this->hasMany(Commune::class);
    }
}
