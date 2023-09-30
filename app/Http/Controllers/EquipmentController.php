<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
{
    $userRequests = ModelsRequest::select('user_id') // Include other columns you need
        ->groupBy('user_id') // Use groupBy instead of distinct
        ->paginate(10);

    return view('equipment.index', compact('userRequests'));
}


    public function items()
    {
        $e_items = Equipment::paginate(20);
        return view('equipment.item', compact('e_items'));
    }

    public function create()
    {
        return view('equipment.create');
    }
    public function store(Request $request)
    {
        //dd($request);
        //return "store function";
        $request->validate([
            'name' => 'required|string',
            'detail' => 'required|string',
            'amount' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $equipment = new Equipment();
        $equipment->name = $request->input('name');
        $equipment->detail = $request->input('detail');
        $equipment->amount = $request->input('amount');
        $equipment->price = $request->input('price');

        if ($equipment->save()) {
            return redirect()->back()->with('success', 'Add Data Success.');
        }
    }
    public function edit($id)
    {
        //return "edit function";
        $equipment = Equipment::find($id);
        return view('equipment.edit', compact('equipment'));
    }


    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string',
            'detail' => 'required|string',
            'amount' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        // Find the equipment record by ID
        $equipment = Equipment::find($id);

        // Check if the equipment record exists
        if ($equipment) {
            // Update the equipment record with the validated data
            $equipment->name = $request->input('name');
            $equipment->detail = $request->input('detail');
            $equipment->amount = $request->input('amount');
            $equipment->price = $request->input('price');

            // Save the updated equipment record
            $equipment->save();

            // Optionally, you can redirect the user after updating the data
            return redirect()->route('items')->with('success', 'Update Data Success.');
        } else {
            // If the equipment record is not found, you can handle the error here
            return redirect()->route('items')->with('error', 'Equipment not found.');
        }
    }

    public function destroy($id)
    {
        //dd($id);
        Equipment::find($id)->delete();
        return redirect()->back()->with('success', 'Delete Data Success.');
    }
}
