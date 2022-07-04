<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuelController extends Controller
{
    public function index()
    {
        $fuels = 0;
        return view('fuels')->with(['fuels' => $fuels]);
    }
}
