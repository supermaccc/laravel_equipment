<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validate data
        $request->validate([
            'name' => 'required|max:150',
            'email' => 'required|email|max:150', 
            'password' => 'required'
        ]);

        // Eloquent - Check for duplicate email
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            return response()->json(['status' => 'duplicate']);
        }

        // If email is unique, create a new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->permision = "user";

        if ($user->save()) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }
}
