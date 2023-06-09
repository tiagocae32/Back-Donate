<?php

namespace App\Models\Campaña;

use App\Models\Campaña\Image;
use App\Traits\CampañasTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaña extends Model
{
    use HasFactory, CampañasTrait;

    protected $table = "campañas";

    protected $fillable = [
        'nombre',
        'descripcion',
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
        return $this->hasMany('App\Models\Campaña\Comentario', 'campaña_id', 'id');
    }

    public function donaciones(){
        return $this->hasMany('App\Models\Campaña\Donacion', 'campaña_id', 'id');
    }

    public function imagenes(){
        return $this->morphMany(Image::class, 'imageable'); //$this->hasMany('App\Models\Campaña\Image', 'campaña_id', 'id');
    }
    
}