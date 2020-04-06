<?php

namespace Kossa\AlgerianCities;

use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
    protected $fillable = ['name'];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id=null)
    {
        $common = [
            'name'    => 'required',
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
