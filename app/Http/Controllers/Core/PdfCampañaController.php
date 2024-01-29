<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\Core\Campaña;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class PdfCampañaController extends Controller
{
    public function downLoadPdfCampaña(Request $request)
    {

        $campaña = Campaña::find($request->idCampaña);

        $pdf = PDF::loadView('pdf.info_campaña', compact('campaña'));

        return $pdf->download('InfoCampaña.pdf');
    }
}
