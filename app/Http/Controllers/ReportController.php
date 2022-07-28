<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fuel;
use App\Models\Pump;
use App\Models\Module;
use PDF;
use Dompdf\Dompdf;
use Auth;

class ReportController extends Controller
{
    public function index()
    {
        $fuel = Fuel::all();
        $pump = Pump::all();
        $modules = Module::all();
        return view('report-new')->with(['fuel' => $fuel, 'pump' => $pump, 'modules' => $modules]);
    }

    public function createPDF(Request $request)
    {
        $reportID = 'REM/'.date('Y/m/d');
        $user = Auth::user();
        $modules = Module::find($request->modules);
        $pump = Pump::find($request->pump);

        $modulesTotalValue = 0;
        foreach($modules as $item)
        {
            $modulesTotalValue += $item->price;
        }

        $totalValue = $modulesTotalValue + $pump->price;
        $tax = 0.08 * $totalValue;
        $grossTotalValue = $totalValue + $tax;

        $clientName = $request->clientName;
        $address = $request->address;
        $city = $request->city;
        $phone = $request->phone;

        $heatingArea = $request->heatingArea;
        $roomHeight = $request->roomHeight;

        $buildingInsulation = $request->buildingInsulation;
        $windows = $request->windows;
        $glazing = $request->glazing;
        $ceiling = $request->ceiling;
        $floor = $request->floor;
        $doors = $request->doors;
        $heaters = $request->heaters;

        $minimalTemperature = $request->minimalTemperature;
        
        $heatLosse = 4 - ($buildingInsulation + $windows + $glazing + $ceiling + $floor + $doors + $heaters);
        $kubatura = $heatingArea * ($roomHeight / 100);
        $annualEnergyExpenditure = ($kubatura * $heatLosse * (21 -(-2)));
        $assumedHeatDemand = $annualEnergyExpenditure / $kubatura;
        
        $sizeFV = ($annualEnergyExpenditure / 1000) / 2.7;

        $pdf = PDF::loadView('reportPDF', [
            'pump' => $pump,
            'clientName' => $clientName,
            'address' => $address,
            'city' => $city,
            'phone' => $phone,
            'user' => $user,
            'heatingArea' => $heatingArea,
            'kubatura' => $kubatura,
            'assumedHeatDemand' => $assumedHeatDemand,
            'annualEnergyExpenditure' => $annualEnergyExpenditure,
            'minimalTemperature' => $minimalTemperature,
            'sizeFV' => $sizeFV,
            'modules' => $modules,
            'modulesTotalValue' => $modulesTotalValue,
            'totalValue' => $totalValue,
            'tax' => $tax,
            'grossTotalValue' => $grossTotalValue,
            'reportID' => $reportID
        ]);
        return $pdf->stream($reportID." | ".$clientName.".pdf");
    }
}
