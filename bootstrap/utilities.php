<?php

use Illuminate\Support\Facades\DB;

/* Funcion para darle una respuesta al usuario, tanto de status ok, como de status failed  */
function responseUser($data,int $statusCode) : object {
    return response()->json($data, $statusCode);
}

function errors($data,$statusCode){
    abort(response()->json($data, $statusCode));
}

/* Funcion para comenzar una transaccion */
function startTransaction() {
    DB::beginTransaction();
}

/* Funcion para realizar un rollback ante cualquier inconveniente */
function rollback($nivel = null) {
    DB::rollback($nivel);
}

/* Funcion para realizar el commit y finalizar la transaccion */
function commit() {
    DB::commit();
}
