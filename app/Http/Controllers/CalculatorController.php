<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use PDF;
use Dompdf\Dompdf;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('calculator');
    }

    public function createPDF(Request $request)
    {
        $ratyStale = $request->ratyStale;
        $ratyMal = $request->ratyMal;

        $pdf = PDF::loadView('pdf.calc', ['ratyStale' => $ratyStale]);
        $dompdf = new Dompdf();
        $dompdf->set_option('isHtml5ParserEnabled', true);

        return $pdf->download('title.pdf');
    }
}
