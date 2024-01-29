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

    public $user_id = null;

    public function index()
    {
        return $this->model::with($this->modelRelations)->get();
    }

    public function store(Request $request)
    {
        //$request->validated();

        startTransaction();

        try {
            $newEntity = $this->model::create($request->all());
        } catch (Exception $exception) {
            rollback();

            return errors(['message' => $exception->getMessage()], 500);
        }

        commit();
        $newEntity = $newEntity->load($this->modelRelations);

        return responseUser($newEntity, 200);
    }
}
