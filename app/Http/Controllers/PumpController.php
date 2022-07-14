<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pump;
class PumpController extends Controller
{
    public function index()
    {
        $pumps = Pump::all();
        return view('pumps')->with(['pumps' => $pumps]);
    }

    public function create()
    {
        return view('pumps-new');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required'
        ]);

        $pump = new Pump;
        $pump->name = $request->name;
        $exploded = explode(',', $request->price);
        if(count($exploded) > 1) {
            $pump->price = $exploded[0] . '.' . $exploded[1];
        } else {
            $pump->price = $request->price;
        }

        $pump->save();

        return redirect()->route('pump.index')->with(['success', 'Pomyślnie dodano nową pompę']);
    }

    public function edit($id)
    {
       $pump = Pump::find($id);
       return view('pumps-edit')->with(['pump' => $pump]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required'
        ]);

        $pump = Pump::find($id);
        $pump->name = $request->name;
        $exploded = explode(',', $request->price);
        if(count($exploded) > 1) {
            $pump->price = $exploded[0] . '.' . $exploded[1];
        } else {
            $pump->price = $request->price;
        }

        $pump->update();
        return redirect()->route('pump.index')->with(['success', 'Pomyślnie edytowano pompę']);
    }

    public function destroy(Request $request, $id)
    {
        Pump::destroy($id);
        return redirect()->route('pump.index')->with(['success', 'Pomyślnie usunięto pompę']);
    }
}
