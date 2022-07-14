<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fuel;
use App\Models\Pump;

class ReportController extends Controller
{
    public function index()
    {
        $fuel = Fuel::all();
        $pump = Pump::all();
        return view('report-new')->with(['fuel' => $fuel, 'pump' => $pump]);
    }
}
