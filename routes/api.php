<?php
use App\Http\Controllers\User\AuthenticationController;
use App\Http\Controllers\Campañas\CampañasController;
use App\Http\Controllers\Campañas\ComentariosController;
use App\Http\Controllers\Campañas\DonacionesController;
use App\Http\Controllers\Campañas\PdfCampañaController;
use App\Http\Controllers\User\UsersController;
use App\Http\Middleware\CheckToken;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('donate')->group(function () {

     // AUTENTICACION
     Route::post('/login', [AuthenticationController::class, 'login']);
     Route::post('/loginGoogle', [AuthenticationController::class, 'loginGoogle']);
     Route::post('/register', [AuthenticationController::class, 'register']);        

     Route::middleware(["auth:sanctum"])->group(function () {

        // Route Users
        Route::post('/logout', [AuthenticationController::class, 'logout']);      
        Route::get('/getUserInfo', [UsersController::class, 'getUserInfo']);
        Route::get('/getUsers', [UsersController::class, 'index']); 
        Route::get('/searchUser/{user}', [UsersController::class, 'searchUser']);

        // Routes Campañas
        //Route::get("/getAllCampañas", [CampañasController::class, "indexAdmin"]);
        Route::get('/getCampanias', [CampañasController::class, 'index']);
        Route::post('/createCampania', [CampañasController::class, 'store']);
        Route::get('/searchCampania/{name}', [CampañasController::class, 'searchCampania']);

        // Routes comentarios
        Route::post('/createComentario', [ComentariosController::class, 'store']);
        Route::delete('/deleteComentario/{id}', [ComentariosController::class, 'destroy']);
        
        // Routes Donaciones
        Route::post('/donaciones', [DonacionesController::class, 'store']);

        // Routes Pdf Campañas
        Route::get('/downloadPdfCampania', [PdfCampañaController::class, 'downloadPdfCampaña']);

     }); 
});