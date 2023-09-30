<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('name', $data['name'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            // User does not exist or password is incorrect
            return response()->json(['status' => 'fail']);
        }

        // Authentication passed
        // The user exists in the database and the credentials are valid

        if ($user->permision == 'admin') {

            //dd($user->permision);
            // Set custom session name for admin
            $request->session()->put('admin', $user->name);
            $request->session()->put('user_id', $user->id);
            return response()->json(['status' => 'success', 'permision' => $user->permision]);

            // return redirect()->route('equipment_index');
        } else if ($user->permision == 'user') {
            // Set custom session name for regular user
            $request->session()->put('user', $user->name);
            $request->session()->put('user_id', $user->id);
            return response()->json(['status' => 'success', 'permision' => $user->permision]);
        } else {
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        // Destroy the admin session
        session()->forget('admin');
        // Destroy the user session
        session()->forget('user');
        session()->forget('user_id');
        // Redirect to login page
        return view('login');
    }
}
