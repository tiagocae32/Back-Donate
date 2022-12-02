<?php

namespace App\Services\Campañas;
use App\Models\Campaña\Image;
use Illuminate\Support\Facades\Storage;

class UploadImage {

    public static function uploadImage($files, $campaniaId){

        foreach($files as $file){
            $nameFile = $file->getClientOriginalName();
            $path = '/' . $campaniaId . '/';
            //guardando el archivo en el path indicado
             Storage::disk("imagenesCampanias")->putFileAs($path, $file, $nameFile);
             $url = Storage::disk('imagenesCampanias')->url($path . $nameFile);
             (new Image(["image" => $url, "campania_id" => $campaniaId]))->save();
       }
    }
}


?>