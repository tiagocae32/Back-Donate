<?php

namespace App\Http\Controllers\DataProviders;

use App\Http\Controllers\Controller;
use App\Models\Core\Campaña;
use App\Models\Core\Donacion;
use App\Models\Core\User;
use Illuminate\Http\Request;

class DataProviderController extends Controller
{
    
    public function index(Request $request){

        $data = $request->all();

        $arrModels = explode(",", $data['models']);

        $dataProviders = [];

        $keyValueModels = [
            'users' => User::class,
            'campañas' => Campaña::class,
            'donaciones' => Donacion::class,
        ];
        

        foreach($arrModels as $model){
            if(isset($keyValueModels[$model])){
                $modelNamespace = $keyValueModels[$model];
                $items = resolve($modelNamespace);
                $dataProviders[$model] = $items->all();
            }
        }

        return response()->json(compact('dataProviders'));

    }
}
