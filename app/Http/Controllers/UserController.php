<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function userPage()
    {
        return view('users.createuser');
    }
    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'location' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'location' => $request->location,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'role'=>$request->role,
        ]);
        return redirect('/user')->with('success', 'User created successful');
    }
}
