<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use Illuminate\Http\Request;

class FormRequestController extends Controller
{
    public function index()
    {
        //$tasks = Task::paginate(10);
        // return view('tasks.index', compact('tasks'));
        return view('equipment.user.form');
    }

    public function getDetail($id)
    {
        // $id = session()->has('user_id');
        // Get request details based on the SQL query
        $requestDetails = ModelsRequest::select('requests.equipment_name', 'equipment.detail', 'requests.amount', 'equipment.price', 'requests.note')
            ->leftJoin('users', 'requests.user_id', '=', 'users.id')
            ->leftJoin('equipment', 'requests.equipment_id', '=', 'equipment.id')
            ->where('requests.user_id', $id)
            ->get();

        return view('equipment.user.detail', compact('requestDetails'));
    }

    public function getAllDetail($id)
    {
        $user = User::find($id);
        // Get request details based on the SQL query
        $requestDetails = ModelsRequest::select('requests.equipment_name', 'equipment.detail', 'requests.amount', 'equipment.price', 'requests.note')
            ->leftJoin('users', 'requests.user_id', '=', 'users.id')
            ->leftJoin('equipment', 'requests.equipment_id', '=', 'equipment.id')
            ->where('requests.user_id', $id)
            ->get();

        return view('equipment.detail', compact('requestDetails', 'user'));
    }

    public function store(Request $request)
    {
        //dd($request);
        //return "store function";
        $data = $request->validate([
            'user_id' => 'required|integer',
            'equipment_name' => 'required|string',
            'amount' => 'required|integer'
        ]);

        $duplicate = ModelsRequest::where('user_id', $data['user_id'])
            ->where('equipment_name', $data['equipment_name'])
            ->first();

        if ($duplicate) {
            // User does not exist or password is incorrect
            return redirect()->back()->with('error', 'You already requested this equipment.');
        }

        $form_request = new ModelsRequest();
        $form_request->user_id = $request->input('user_id');
        $form_request->equipment_name = $request->input('equipment_name');
        $form_request->equipment_id = $request->input('equipment_id');
        $form_request->amount = $request->input('amount');
        $form_request->note = $request->input('note');

        if ($form_request->save()) {
            return redirect()->back()->with('success', 'Add Data Success.');
        }
    }

    public function getModels(Request $request)
    {
        $name = $request->input('name');
        $models = Equipment::where('name', $name)->get();

        return response()->json(['models' => $models]);
    }
}
