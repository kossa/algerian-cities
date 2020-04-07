<?php

namespace Kossa\AlgerianCities;

use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
    protected $fillable = ['name', 'name_ar'];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id=null)
    {
        $common = [
            'name'    => 'required',
            'name_ar'    => 'required',
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
