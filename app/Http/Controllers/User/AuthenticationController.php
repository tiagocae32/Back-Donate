<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserLoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\Users\RegisterUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'loginGoogle', 'register']]);
    }

    public function login(StoreUserLoginRequest $request){
        
        $credentials = $request->only('name', 'password');

        $request->validated();

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
            'user' => User::datosUser($user ? $user->id : null),
        ]);
        return responseUser($userCollect,200);
    }

    public function returnErrorLogin(){
        returnErrors(['errors' => ['Credenciales incorrectas']], 400);
    }

    public function register(StoreUserRequest $request){
        $request->validated();
        $newUser = RegisterUser::register($request->all());
        return responseUser($newUser,200);
        
    }

    public function logout(){
        if (JWTAuth::invalidate(JWTAuth::getToken())) {
            return responseUser(['message' => 'Cerrada correctamente'], 200);
        }
        return responseUser(['message' => 'Error al cerrar sesion'], 401);
    }
}