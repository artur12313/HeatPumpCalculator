<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::all();

        return view('modules')->with(['modules' => $modules]);
    }

    public function create()
    {
        return view('modules-new');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required'
        ]);

        $module = new Module;
        $module->name = $request->name;
        $exploded = explode(',', $request->price);
        if(count($exploded) > 1) {
            $module->price = $exploded[0] . '.' . $exploded[1];
        } else {
            $module->price = $request->price;
        }

        $module->save();

        return redirect()->route('modules.index')->with(['success', 'Pomyślnie dodano nowy moduł']);
    }
    
    public function edit($id)
    {
        $module = Module::find($id);
        return view('modules-edit')->with(['module' => $module]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required'
        ]);

        $module = Module::find($id);
        $module->name = $request->name;
        $exploded = explode(',', $request->price);
        if(count($exploded) > 1) {
            $module->price = $exploded[0] . '.' . $exploded[1];
        } else {
            $module->price = $request->price;
        }

        $module->update();
        return redirect()->route('modules.index')->with(['success', 'Pomyślnie edytowano moduł']);
    }

    public function destroy(Request $request, $id)
    {
        Module::destroy($id);
        return redirect()->route('modules.index')->with(['success', 'Pomyślnie usunięto moduł']);
    }
}
