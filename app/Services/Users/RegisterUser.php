<?php

    namespace App\Services\Users;

    use App\Models\User;
    use Illuminate\Support\Facades\Hash;

    class RegisterUser  {

        public static function register($data){
            startTransaction();
            $data['password'] = Hash::make($data['password']);
            $data['rol_id'] = 2;
            $newUser = new User($data);
            $newUser->save();
            commit();
            return $newUser;
        }
    }
?>