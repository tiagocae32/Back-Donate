<?php

namespace App\Services\Campañas;
use App\Models\Campaña\Image;
use Illuminate\Support\Facades\Storage;

class UploadImage {

    public static function uploadImage($files, $campañaId){

        foreach($files as $file){
            $nameFile = $file->getClientOriginalName();
            $path = '/' . $campañaId . '/';
            //guardando el archivo en el path indicado
             Storage::disk("imagenesCampañas")->putFileAs($path, $file, $nameFile);
             //$url = Storage::disk('imagenesCampañas')->url($path . $nameFile);
             (new Image(["image" => $nameFile, "campaña_id" => $campañaId]))->save();
       }
    }
}


?>