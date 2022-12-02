<?php
 
 namespace App\Services\Campañas;
 
 use App\Http\Requests\StoreCampañaRequest;
 use App\Models\Campaña\Campaña;
 use Exception;
 use App\Services\Campañas\UploadImage;
 
 class CreateCampania {

    public static function create(StoreCampañaRequest $request){

        $data = $request->all();
        $data["user_id"] = auth()->user()->id;
        $data["fondos_recaudado_actual"] = 0;

        $newCampania = new Campaña($data);

        startTransaction();

        try{
            $newCampania->save();
            if($request->hasFile("images")){
               $files = $request->file("images");
               UploadImage::uploadImage($files, $newCampania->id);
            }
            commit();

            $newCampania = Campaña::with(Campaña::MODEL_RELATIONS)->find($newCampania->id);
            return $newCampania;
        }catch(Exception $exception){
            rollBack();
            return responseUser(['message' => $exception->getMessage()], 500);
        }
    }
 }

?>