<?php

namespace App\Models\DataProviders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class, 'rol_id', 'id');
    }

    public static function validatorGeneral($input)
    {
        $rules = ['name' => 'string|required|max:50'];
        $validator = Validator::make($input, $rules);

        return $validator;
    }
}
