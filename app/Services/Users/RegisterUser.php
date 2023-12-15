<?php

namespace App\Services\Users;

use App\Models\Core\User;
use App\Services\Campañas\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterUser
{
    public static function register(Request $request)
    {
        startTransaction();
        $data = $request->all();
        $data['contraseña'] = Hash::make($data['contraseña']);
        $data['rol_id'] = 2;
        $newUser = new User($data);
        $newUser->save();

        if ($request->hasFile('images')) {
            $dataImage = [
                'disk' => 'userImagenes',
                'files' => $request->file('images'),
                'imageable_id' => $newUser->id,
                'imageable_type' => User::class,
            ];
            UploadImage::uploadImage($dataImage);
        }

        commit();

        return $newUser;
    }
}
