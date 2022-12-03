<?php

namespace App\Models\Campaña;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Donacion extends Model
{
    use HasFactory;

    protected $table = "donaciones";

    protected $fillable = [
        'dinero_donado',
        'campania_id',
        'user_id',
    ];

    // Relaciones
    public function campania(){
        return $this->belongsTo('App\Models\Campaña\Campaña', 'campania_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public static function validatorGeneral($data){
        $rules = [
            'dinero_donado' => ['required','integer'],
            'campania_id' => ['required','integer','exists:campañas,id'],
            'user_id' => ['required','integer','exists:users,id']
        ];

        $validator = Validator::make($data, $rules);

        return $validator;
    }
}
