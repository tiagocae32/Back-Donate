<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait UsersTrait {

    protected static function booted(){
        static::addGlobalScope('orderUsers', function (Builder $builder) {
            $builder->orderBy("nombre");
        });
    }

    //Scopes
    public static function scopeUsers($query, $username){
        return $query->where('id', '!=', 1)->where('nombre', 'like', '%' . $username . '%')->with(["campañas", "rol"])->get();
    }

    public static function datosUser($idLoginGoogle = null){
        $id = !$idLoginGoogle ? Auth::id() : $idLoginGoogle;

        $user = User::select(['id', "email", "nombre", "rol_id"])->with([
            'campañas',
            'campañas.comentarios' => function($query){
                $query->select(['id','campaña_id', 'user_id' ,'created_at', 'comentario']);
            },
            'campañas.comentarios.user' => function($query){
                $query->select(['id','nombre','created_at']);
            },
            'campañas.user' => function ($query){
                $query->select(['id','nombre', 'email']);
            },
            'campañas.imagenes' => function ($query){
                $query->select(['id','imageable_id', 'path']);
            }       
        ])->where('id' , $id)->get()->first();
        
        if($user->rol_id !== 1){
            $user["permisos"] = self::permisos();
        }
        return $user;
    }

}