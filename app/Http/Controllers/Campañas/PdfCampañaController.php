<?php

namespace App\Http\Controllers\Campañas;

use App\Models\Campaña\Campaña;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PdfCampañaController extends Controller
{
    public function downLoadPdfCampaña(Request $request){

        $campania = Campaña::find($request->idCampania);

        $pdf = PDF::loadView('pdf.info_campania', compact('campania'));
        return $pdf->download('InfoCampaña.pdf');
    }
}
