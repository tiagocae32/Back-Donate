<?php
use App\Http\Controllers\User\AuthenticationController;
use App\Http\Controllers\Campañas\CampañasController;
use App\Http\Controllers\Campañas\ComentariosController;
use App\Http\Controllers\Campañas\DonacionesController;
use App\Http\Controllers\Campañas\PdfCampañaController;
use App\Http\Controllers\User\UsersController;
use App\Http\Middleware\CheckToken;

Route::prefix('donate')->group(function () {

   // Auth routes
   Route::controller(AuthenticationController::class)->group(function () {
      Route::post('/login','login');
      Route::post('/loginGoogle','loginGoogle');
      Route::post('/registrarUsuario','register');
   });
     
   Route::middleware(CheckToken::class)->group(function () {

      Route::post('/logout', [AuthenticationController::class, 'logout']);

      // Users routes
      Route::controller(UsersController::class)->group(function () {
         Route::get('/getUserInfo','getUserInfo');
         Route::get('/getUsers','index');
         Route::put('/editarUsuario/{id}','update'); 
         Route::get('/buscarUsuarios/{user}','searchUsers');
      });
        
      // Campañas routes
      Route::controller(CampañasController::class)->group(function () {
         //Route::get("/getAllCampañas", [CampañasController::class, "indexAdmin"]);
         Route::get('/getCampanias','index');
         Route::get('/getCampania/{id}','getCampaña');
         Route::post('/crearCampania','store');
         Route::get('/buscarCampanias/{name}','searchCampañas');
         Route::delete('/eliminarCampania/{id}','destroy');
      });

      // Comentarios routes
      Route::controller(ComentariosController::class)->group(function () {
         Route::post('/createComentario','store');
         Route::delete('/eliminarComentario/{id}','destroy');
      });   
        
        // Donaciones routes 
        Route::controller(DonacionesController::class)->group(function () {
            Route::post('/donaciones', 'store');
        });

        // Pdf campañas routes
        Route::controller(PdfCampañaController::class)->group(function () {
            Route::get('/descargarPdfCampania','downloadPdfCampaña');
        });
     }); 
});