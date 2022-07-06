<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fuel;

class FuelController extends Controller
{
    public function index()
    {
        $fuels = Fuel::all();
        return view('fuels')->with(['fuels' => $fuels]);
    }

    public function create()
    {
        return view('fuels-new');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'efficiency' => 'required',
            'caloricValue' => 'required',
            'price' => 'required'
        ]);

        $fuel = new Fuel;
        $fuel->name = $request->name;
        $fuel->efficiency = $request->efficiency;
        $fuel->caloricValue = $request->caloricValue;
        $exploded = explode(',', $request->price);
        if(count($exploded) > 1) {
            $fuel->price = $exploded[0] . '.' . $exploded[1];
        } else {
            $fuel->price = $request->price;
        }
        $fuel->unit = $request->unit;
        $fuel->save();

        return redirect()->route('fuels.index')->with('success', 'Pomyślnie dodano');
    }

    public function edit($id)
    {
        $fuel = Fuel::find($id);

        return view('fuels-edit')->with(['fuel' => $fuel]);
    }

    public function update(Request $request, $id)
    {

        $fuel = Fuel::find($id);
        $fuel->name = $request->name;
        $fuel->efficiency = $request->efficiency;
        $fuel->caloricValue = $request->caloricValue;
        $exploded = explode(',', $request->price);
        if(count($exploded) > 1) {
            $fuel->price = $exploded[0] . '.' . $exploded[1];
        } else {
            $fuel->price = $request->price;
        }
        $fuel->unit = $request->unit;
        $fuel->update();

        return redirect()->route('fuels.index')->with(['success', 'Pomyślnie zaktualizowano']);
    }

    public function destroy(Request $request, $id)
    {
        Fuel::destroy($id);
        return redirect()->route('fuels.index')->with(['success', 'Pomyślnie usunięto']);
    }
}
