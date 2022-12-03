<?php

namespace App\Models\Campaña;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaña extends Model
{
    use HasFactory;

    protected $table = "campanias";

    protected $fillable = [
        'name',
        'description',
        'fondos_a_recaudar',
        'fondos_recaudado_actual',
        'user_id',
    ];

    const MODEL_RELATIONS = [
        "user",
        "comentarios",
        "imagenes"
    ];

    //Relaciones    
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function comentarios(){
        return $this->hasMany('App\Models\Comentario', 'campania_id', 'id');
    }

    public function donaciones(){
        return $this->hasMany('App\Models\Donacion', 'campania_id', 'id');
    }

    public function imagenes(){
        return $this->hasMany('App\Models\Image', 'campania_id', 'id');
    }

    //Scopes
    public static function scopeCampania($query, $nameCampania){
        return $query->whereNotIn('user_id', [auth()->user()->id])->where('name', 'like', '%' . $nameCampania . '%')->with(self::MODEL_RELATIONS)->get();
    }
}