<?php
 
 namespace App\Services\Campañas;
 
 use App\Http\Requests\StoreComentarioRequest;
 use App\Models\Campaña\Comentario;
 use Exception;
 
 class CreateComentario {

    public static function create(StoreComentarioRequest $request){

        startTransaction();

        $data = $request->all();

        $newComentario = Comentario::create([
            'user_id' => auth()->user()->id,
            'campaña_id' => $data['campaña_id'],
            'comentario' => $data['comentario']
        ]);
        try{
            commit();
            return $newComentario->load("user"); // Devolviendo el comentario con su respectiva relacion
        }catch(Exception $exception){
            rollBack();
            return responseUser(['message' => $exception->getMessage()], 500);
        }
    }
 }

?>