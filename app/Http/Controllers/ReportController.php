<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fuel;

class ReportController extends Controller
{
    public function index()
    {
        $fuel = Fuel::all();
        return view('report-new')->with(['fuel' => $fuel]);
    }
}
