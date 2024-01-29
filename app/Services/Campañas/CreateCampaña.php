<?php

namespace App\Services\Campañas;

use App\Http\Requests\StoreCampañaRequest;
use App\Models\Core\Campaña;
use Exception;

class CreateCampaña
{
    public static function create(StoreCampañaRequest $request)
    {

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        //$data["fondos_recaudado_actual"] = 0;

        $newCampaña = new Campaña($data);

        startTransaction();

        try {
            $newCampaña->save();
            if ($request->hasFile('images')) {
                $dataImage = [
                    'disk' => 'imagenesCampañas',
                    'files' => $request->file('images'),
                    'imageable_id' => $newCampaña->id,
                    'imageable_type' => Campaña::class,
                ];
                UploadImage::uploadImage($dataImage);
            }
            commit();

            $newCampaña = Campaña::with(Campaña::MODEL_RELATIONS)->find($newCampaña->id);

            return $newCampaña;
        } catch (Exception $exception) {
            rollBack();

            return responseUser(['message' => $exception->getMessage()], 500);
        }
    }
}
