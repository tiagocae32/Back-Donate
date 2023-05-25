<?php

namespace App\Http\Controllers;

use App\Interfaces\ResourceController;
use Exception;
use Illuminate\Http\Request;

class CrudResourceController extends Controller implements ResourceController
{

    // Variables

    public $model = null;

    public $modelRelations = null;
    

    public function index(){
        return $this->model::with($this->modelRelations)->get();
    }


    public function store(Request $request){
        //$request->validated();

        try{
            $newEntity = new $this->model($request->all());

            return responseUser($newEntity, 200);
        }catch(Exception $exception){
            return errors(['message' => $exception->getMessage()], 500);
        }
    }
}
