<?php

namespace App\Services\Campañas;
use App\Models\Campaña\Image;
use Illuminate\Support\Facades\Storage;

class UploadImage {

    public static function uploadImage($files, $imageable_id, $model){

        //dump($campañaId);

        foreach($files as $file){
            $nameFile = $file->getClientOriginalName();
            $path = '/' . $imageable_id . '/';
            //guardando el archivo en el path indicado
             Storage::disk("imagenesCampañas")->putFileAs($path, $file, $nameFile);
             $newImage = new Image(["path" => $nameFile, 'imageable_id' => $imageable_id, 'imageable_type' => $model]);
             $newImage->save();
       }
    }
}


?>