<?php

namespace App\Models\Core;

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
        'campaña_id',
        'comentario'
    ];

    //Relaciones
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function campaña()
    {
        return $this->belongsTo(Campaña::class, 'user_id', 'id');
    }
}
