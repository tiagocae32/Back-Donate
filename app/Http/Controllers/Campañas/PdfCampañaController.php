<?php

namespace App\Http\Controllers\Campañas;

use App\Models\Campaña\Campaña;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PdfCampañaController extends Controller
{
    public function downLoadPdfCampaña(Request $request){

        $campaña = Campaña::find($request->idCampaña);

        $pdf = PDF::loadView('pdf.info_campaña', compact('campaña'));
        return $pdf->download('InfoCampaña.pdf');
    }
}
