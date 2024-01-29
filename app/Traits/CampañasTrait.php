<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait CampañasTrait {


    protected static function booted(){
        static::addGlobalScope('orderCampañas', function (Builder $builder) {
            $builder->orderBy("name");
        });
    }

    public function scopeCampañas(Builder $query, $nameCampaña){
        return $query->whereNotIn('user_id', [auth()->user()->id])->where('name', 'like', '%' . $nameCampaña . '%')->with(self::MODEL_RELATIONS)->get();
    }

}