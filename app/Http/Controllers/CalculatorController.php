<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use PDF;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('calculator');
    }

    public function createPDF(Request $request)
    {
        
    }
}
