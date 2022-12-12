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
     Route::post('/registrarUsuario', [AuthenticationController::class, 'register']);        

     Route::middleware(CheckToken::class)->group(function () {

        // Route Users
        Route::post('/logout', [AuthenticationController::class, 'logout']);      
        Route::get('/getUserInfo', [UsersController::class, 'getUserInfo']);
        Route::get('/getUsers', [UsersController::class, 'index']); 
        Route::get('/buscarUsuarios/{user}', [UsersController::class, 'searchUsers']);

        // Routes Campañas
        //Route::get("/getAllCampañas", [CampañasController::class, "indexAdmin"]);
        Route::get('/getCampanias', [CampañasController::class, 'index']);
        Route::get('/getCampania/{id}', [CampañasController::class, 'getCampaña']);
        Route::post('/crearCampania', [CampañasController::class, 'store']);
        Route::get('/buscarCampanias/{name}', [CampañasController::class, 'searchCampañas']);
        Route::delete('/eliminarCampania/{id}', [CampañasController::class, 'destroy']);

        // Routes comentarios
        Route::post('/createComentario', [ComentariosController::class, 'store']);
        Route::delete('/eliminarComentario/{id}', [ComentariosController::class, 'destroy']);
        
        // Routes Donaciones
        Route::post('/donaciones', [DonacionesController::class, 'store']);

        // Routes Pdf Campañas
        Route::get('/descargarPdfCampania', [PdfCampañaController::class, 'downloadPdfCampaña']);

     }); 
});