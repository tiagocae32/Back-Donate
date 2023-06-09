<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait CampañasTrait {


    protected static function booted(){
        static::addGlobalScope('orderCampañas', function (Builder $builder) {
            $builder->orderBy("nombre");
        });
    }

    public function scopeCampañas($query, $nameCampaña){
        return $query->whereNotIn('user_id', [auth()->user()->id])->where('nombre', 'like', '%' . $nameCampaña . '%')->with(self::MODEL_RELATIONS)->get();
    }

}