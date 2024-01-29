<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Donacion extends Model
{
    use HasFactory;

    protected $table = 'donaciones';

    protected $fillable = [
        'dinero_donado',
        'campaña_id',
        'user_id',
    ];

    // Relaciones
    public function campaña()
    {
        return $this->belongsTo(Campaña::class, 'campaña_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function validatorGeneral($data)
    {
        $rules = [
            'dinero_donado' => ['required', 'integer'],
            'campaña_id' => ['required', 'integer', 'exists:campañas,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];

        $validator = Validator::make($data, $rules);

        return $validator;
    }
}
