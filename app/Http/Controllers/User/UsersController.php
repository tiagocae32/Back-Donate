<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{

    /*public function __construct()
    {
        $this->middleware("auth");
    }*/

    public function getUserInfo(Request $request)
    {
        $user = User::datosLogin();
        return responseUser($user, 200);
    }

    //Busca los usuarios que contengan la palabra ingresada por el usuario. Buscamos por nombre de usuario
    public function searchUser ($userName){
        $user = User::user($userName); // Usando query scopes;
        return $user;
    }

    //Index users no deleted
    public function index(Request $request){
        $deleted = !is_null($request->deleted) && $request->deleted === 'true' ? true : false;  
        if($deleted){
            $users = User::onlyTrashed()->with("campañas")->get();
        }else{
            $users =  User::select(['id','name','email','rol_id'])
            ->where(['rol_id' => 2])
            ->with(['campañas' => function($query){
                $query->select(['id', 'user_id']);
            }])->get();
        }
        return $users;
    }

    public function getUser($id){
        $user = User::find($id); //Find busca por la primary key
        return $user;
    }

    public function update(Request $request, $id){
        $datos = $request->all();
        $user = User::find($id);

        try{
            startTransaction();
            $user->fill($datos); // "Llenando el modelo con la informacion recibida en la request"
            if($user->isDirty()){ // Verificando si el modelo ha tenido alguna modificacion
                $attrsChanged = $user->getDirty(); // Obteniendo los atributos que han sido modificados
                foreach($attrsChanged as $key => $newData){
                    $user[$key] = $newData;
                }
                $user->save();
                commit();
                return responseUser($user,200);
            }
        }catch(Exception $error){
            rollback();
            responseUser(['message' => $error->getMessage()], 500);
        }
    }

    public function delete($id){
        $user = User::find($id);    
        $user->delete();
    }

    public function restoreUser($id)
    {
        try {
            $userRestore = User::onlyTrashed()->findOrFail($id);
            $userRestore->restore();
        } catch (ModelNotFoundException $error) {
            responseUser(['message' => $error->getMessage()], 404);
        } catch (Exception $error) {
            responseUser(['message' => $error->getMessage()], 500);
        }
    }
}