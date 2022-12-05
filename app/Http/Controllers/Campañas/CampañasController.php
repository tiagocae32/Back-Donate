<?php

namespace App\Http\Controllers\Campañas;

use App\Http\Requests\StoreCampañaRequest;
use App\Models\Campaña\Campaña;
use App\Services\Campañas\CreateCampaña;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CampañasController extends Controller
{

    // Retorna todas las campañias(Para que las vea el admin)
    public function indexAdmin(){
        $campañas = Campaña::with(Campaña::MODEL_RELATIONS)->get();
        return $campañas;
     }

    // Retorna todas las campañias salvo las del usuario que esta logueado
    public function index(){
       $campañas = Campaña::select(['id','name','description','fondos_a_recaudar','fondos_recaudado_actual','user_id'])
       ->with([
        'user' => function($query) {
            $query->select(['id','name']);
        },
        'comentarios' => function ($query){
            $query->select(['id','campania_id', 'user_id', 'comentario', 'created_at']);
        },
        'comentarios.user' => function ($query){
            $query->select(['id','name']);
        },
        'imagenes' => function ($query){
            $query->select(['campania_id', 'image']);
        },  
        ])->whereNotIn('user_id' , [Auth::id()])->orderBy('id', 'desc')->get();
       return $campañas;
    }

    // Retorna la informacion de una campañia en particular
    public function getCampania($id){
        $campaña = Campaña::where(['id' => $id])->with(Campaña::MODEL_RELATIONS)->get()->first();
        return $campaña;
    }

    //Busca las campañas que contengan la palabra ingresada por el usuario. Buscamos por nombre de campaña
    public function searchCampania ($name){
        $campaña = Campaña::campania($name);
        return $campaña;
    }

    // Crea una campaña
    public function store(StoreCampañaRequest $request){
        
        $request->validated();

        $newCampania = CreateCampaña::create($request);

        return responseUser($newCampania, 200);

    }

    // Elimina una campaña
    public function destroy($id){
        $campaniaDelete = Campaña::find($id);
        if(auth()->user()->id === $campaniaDelete->user_id){
            $campaniaDelete->delete();
            return responseUser(["message" => "Campaña eliminada"],200);
        }
    }
}
