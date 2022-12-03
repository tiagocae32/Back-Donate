<?php

    namespace App\Services\Users;

    use App\Http\Requests\StoreUserRequest;
    use App\Models\User\User;
    use Illuminate\Support\Facades\Hash;
    use Exception;

    class RegisterUser  {

        public static function register(StoreUserRequest $request){

            startTransaction();

            $data = $request->all();

            $data['password'] = Hash::make($data['password']);
            $data['rol_id'] = 2;
            $newUser = new User($data);

            try{
                $newUser->save();
                commit();
                return $newUser;
            }catch(Exception $exception){
                rollback();
                return responseUser(['message' => $exception->getMessage()], 500);
            }
        }
    }
?>