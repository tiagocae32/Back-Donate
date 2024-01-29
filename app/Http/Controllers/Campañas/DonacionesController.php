<?php

namespace App\Http\Controllers\Campañas;

use App\Models\Campaña\Campaña;
use App\Models\Campaña\Donacion;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonacionesController extends Controller
{

    protected $model = "App\Donacion";

    public function store(Request $request){

        startTransaction();

        $data = $request->all();
        $data["user_id"] = auth()->user()->id;

        $validator = Donacion::validatorGeneral($data);
        if($validator->fails()){
            return responseUser(['message' => $validator->fails()], 400);
        }

        $newDonacion = new Donacion($data);

        // Sumando el dinero donado a la tabla campañas en la columna fondos recaudado actual
        $campaña = Campaña::find($data["campaña_id"]);
        $campaña->fondos_recaudado_actual += $data["dinero_donado"];
        $campaña->save();

        try{
            $newDonacion->save();
            commit();
            return responseUser($newDonacion,200);
        }catch(Exception $exception){
            rollback();
            return responseUser(['message' => $exception->getMessage()], 500);
        }
    }
}
