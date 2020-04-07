<?php

namespace Kossa\AlgerianCities;

use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
    protected $fillable = ['name', 'arabic_name'];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id=null)
    {
        $common = [
            'name'    => 'required',
            'arabic_name'    => 'required',
        ];

        return $common;
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
