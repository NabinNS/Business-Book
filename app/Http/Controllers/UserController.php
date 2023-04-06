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
            'gender' =>'required',
            'birthday' =>'required',
        ]);
        
            $profilephoto = $request->profilephoto;
            if ($request->hasFile('profilephoto')) {
                $profilephoto = $request->name . '.' . $request->profilephoto->extension();
                $request->profilephoto->move(public_path('images'), $profilephoto);
            }
  
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'location' => $request->location,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'role'=>$request->role,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'profile'=>$profilephoto
        ]);
        return redirect()->back()->with('success', 'User created successful');
    }
    public function userList(){
        $users = User::all();
        return view('users.users',compact('users'));
    }
    public function viewUserList($id){

        $user = User::find($id);
        return view('users.viewuser',compact('user'));
    }
    public function deleteUser($id){
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'error' => 'Record not found']);
        }
    }
}
