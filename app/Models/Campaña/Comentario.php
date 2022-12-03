<?php

namespace App\Models\Campaña;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    // Model Table
    protected $table = "comentarios";
    
    //Fillable
    protected $fillable = [
        'user_id',
        'campania_id',
        'comentario'
    ];

    //Relaciones
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function campania()
    {
        return $this->belongsTo('App\Models\Campania', 'user_id', 'id');
    }
}
