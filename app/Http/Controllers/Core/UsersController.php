<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\Core\User;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsersController extends Controller
{
    /*public function __construct()
    {
        $this->middleware("auth");
    }*/

    public function getUserInfo()
    {
        $user = User::datosUser(); //JWTAuth::toUser(JWTAuth::getToken());

        return responseUser($user, 200);
    }

    //Busca los usuarios que contengan la palabra ingresada por el usuario. Buscamos por name de usuario
    public function searchUsers($userName)
    {
        $users = User::users($userName); // Usando query scopes;

        return $users;
    }

    //Index users no deleted
    public function index(Request $request)
    {
        $deleted = ! is_null($request->deleted) && $request->deleted === 'true' ? true : false;
        if ($deleted) {
            $users = User::onlyTrashed()->with('campañas')->get();
        } else {
            $users = User::select(['id', 'name', 'email', 'rol_id', 'created_at'])
                ->where('rol_id', '!=', 1)
                ->with(
                    [
                        'campañas' => function ($query) {
                            $query->select(['id', 'user_id']);
                        },
                        'rol' => function ($query) {
                            $query->select(['id', 'rol']);
                        },
                    ]
                )->get();
        }

        return $users;
    }

    public function getUser($id)
    {
        $user = User::find($id); //Find busca por la primary key

        return $user;
    }

    public function update(Request $request, User $user)
    {
        try {
            startTransaction();
            $user->update($request->all());
        } catch (Exception $error) {
            rollback();
            responseUser(['message' => $error->getMessage()], 500);
        }
        commit();

        return responseUser($user, 200);
    }

    public function delete(User $user)
    {
        $user->delete();
    }

    public function restoreUser(User $user)
    {
        try {
            if ($user->trashed()) {
                $user->restore();
            }
        } catch (Exception $error) {
            responseUser(['message' => $error->getMessage()], 500);
        }

        return responseUser($user, 200);
    }
}
