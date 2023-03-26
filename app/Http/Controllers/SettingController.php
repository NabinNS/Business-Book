<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function settingPage($id)
    {
        $user = User::find($id);
        return view('settings.setting', compact('user'));
    }
    public function updateUser($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'location' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $user = User::find($id);
        $user->update([
            'name'=> $request->name,
            'password' => Hash::make($request->password),
            'location' => $request->location,
            'email' => $request->email,
            'phone_number' => $request->phone,
        ]);
        return redirect('setting/' . $id)->with('success', 'User update successful');
    }
}
