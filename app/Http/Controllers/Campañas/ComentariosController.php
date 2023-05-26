<?php

namespace App\Http\Controllers\Campañas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CrudResourceController;
use App\Http\Requests\StoreComentarioRequest;
use App\Models\Campaña\Comentario;
use App\Services\Campañas\CreateComentario;

class ComentariosController extends Controller //CrudResourceController
{

    public $model = Comentario::class;

    //public $user_id = auth()->user()->id;

    public $modelRelations = [
        'user',
    ];

    public function store(StoreComentarioRequest $request){
        
        $request->validated();

        $newComentario = CreateComentario::create($request);

        return responseUser($newComentario,200);
    }

    public function destroy($id){
        $comentarioDelete = Comentario::find($id);
        if(Auth()->user()->id === $comentarioDelete->user_id){
            $comentarioDelete->delete();
            return responseUser($comentarioDelete,200);
        }
    }
}
