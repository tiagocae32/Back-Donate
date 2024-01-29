<?php

namespace App\Services\Campañas;
use App\Models\Campaña\Image;
use Illuminate\Support\Facades\Storage;

class UploadImage {

    public static function uploadImage($dataImage){

        foreach($dataImage["files"] as $file){
            $nameFile = $file->getClientOriginalName();
            $path = '/' . $dataImage["imageable_id"] . '/';
            //guardando el archivo en el path indicado
             Storage::disk($dataImage["disk"])->putFileAs($path, $file, $nameFile);
             $newImage = new Image(["path" => $nameFile, 'imageable_id' => $dataImage["imageable_id"],
                                     'imageable_type' => $dataImage["imageable_type"]]);
             $newImage->save();
       }
    }
}


?>