<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User\User;
use App\Services\Users\RegisterUser;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'loginGoogle', 'register']]);
    }

    public function login(Request $request){
        
        $credentials = $request->only('name', 'password');

        if($token = JWTAuth::attempt($credentials)){
            return $this->collectAndReturnUserData($token);
        }

        return $this->returnErrorLogin();
    }

    public function loginGoogle(Request $request){
      
        $user = User::where('email', $request->input('email'))->get()->first();
        
        if($user && $token = JWTAuth::fromUser($user)){
            return $this->collectAndReturnUserData($token, $user);
        }

        return $this->returnErrorLogin();
    }


    public function collectAndReturnUserData($token , $user = null){
        $userCollect = collect([
            'token'  => $token,
            'user' => User::datosLogin($user ? $user->id : null),
        ]);
        return responseUser($userCollect,200);
    }

    public function returnErrorLogin(){
        return responseUser(['message' => 'Credenciales incorrectas'], 400);
    }

    public function register(StoreUserRequest $request){

        // Always use form request validation
        // Not use request->all to validate
        $request->validated();

        $newUser = RegisterUser::register($request);

        return responseUser($newUser,200);
        
    }

    public function logout(){
        if (JWTAuth::invalidate(JWTAuth::getToken())) {
            return responseUser(['message' => 'Cerrada correctamente'], 200);
        }
        return responseUser(['message' => 'Error al cerrar sesion'], 401);
    }
}
