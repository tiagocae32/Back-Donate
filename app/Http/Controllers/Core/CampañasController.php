<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CrudResourceController;
use App\Http\Requests\StoreCampañaRequest;
use App\Models\Core\Campaña;
use App\Services\Campañas\CreateCampaña;
use Illuminate\Support\Facades\Auth;

class CampañasController extends Controller //CrudResourceController
{
    // Retorna todas las campañias(Para que las vea el admin)
    public function indexAdmin()
    {
        $campañas = Campaña::with(Campaña::MODEL_RELATIONS)->get();

        return $campañas;
    }

    // Retorna todas las campañias salvo las del usuario que esta logueado
    public function index()
    {
        $campañas = Campaña::select(['id', 'name', 'descripcion', 'fondos_a_recaudar', 'fondos_recaudado_actual', 'user_id'])
            ->with([
                'user' => function ($query) {
                    $query->select(['id', 'name']);
                },
                'comentarios' => function ($query) {
                    $query->select(['id', 'campaña_id', 'user_id', 'comentario', 'created_at']);
                },
                'comentarios.user' => function ($query) {
                    $query->select(['id', 'name']);
                },
                'imagenes' => function ($query) {
                    $query->select(['imageable_id', 'path']);
                },
            ])->whereNotIn('user_id', [Auth::id()])->orderBy('id', 'desc')->get();

        return $campañas;
    }

    // Retorna la informacion de una campañia en particular
    public function getCampaña(Campaña $campaña)
    {
        return $campaña->with(Campaña::MODEL_RELATIONS)->get()->first();
    }

    //Busca las campañas que contengan la palabra ingresada por el usuario. Buscamos por name de campaña
    public function searchCampañas($name)
    {
        $campañas = Campaña::campañas($name);

        return $campañas;
    }

    // Crea una campaña
    public function store(StoreCampañaRequest $request)
    {

        $request->validated();

        $newCampaña = CreateCampaña::create($request);

        return responseUser($newCampaña, 200);
    }

    // Elimina una campaña
    public function destroy(Campaña $campaña)
    {
        if (auth()->user()->id === $campaña->user_id) {
            $campaña->comentarios()->delete();
            $campaña->imagenes()->delete();
            $campaña->donaciones()->delete();
            $campaña->delete();

            return responseUser($campaña->id, 200);
        }
    }
}
