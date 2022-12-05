<?php
 
 namespace App\Services\Campañas;
 
 use App\Http\Requests\StoreCampañaRequest;
 use App\Models\Campaña\Campaña;
 use Exception;
 use App\Services\Campañas\UploadImage;
 
 class CreateCampaña {

    public static function create(StoreCampañaRequest $request){

        $data = $request->all();
        $data["user_id"] = auth()->user()->id;
        $data["fondos_recaudado_actual"] = 0;

        $newCampaña = new Campaña($data);

        startTransaction();

        try{
            $newCampaña->save();
            if($request->hasFile("images")){
               $files = $request->file("images");
               UploadImage::uploadImage($files, $newCampaña->id);
            }
            commit();

            $newCampaña = Campaña::with(Campaña::MODEL_RELATIONS)->find($newCampaña->id);
            return $newCampaña;
        }catch(Exception $exception){
            rollBack();
            return responseUser(['message' => $exception->getMessage()], 500);
        }
    }
 }

?>