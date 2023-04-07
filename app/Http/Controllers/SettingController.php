<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function settingPage($id)
    {
        $user = User::find($id);
        $userCompany = UserCompany::first();
        return view('settings.setting', compact('user', 'userCompany'));
    }
    public function updateUser($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
        ]);
        $user = User::find($id);
        $profilephoto = $request->profilephoto;
        if ($request->hasFile('profilephoto')) {
            $profilephoto = $request->name . '.' . $request->profilephoto->extension();
            $request->profilephoto->move(public_path('images'), $profilephoto);
        }
        $user->update([
            'name' => $request->name,
            'location' => $request->location,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'profile' => $profilephoto
        ]);
        return redirect()->back()->with('success', 'User update successful');
    }
    public function updatePassword($id, Request $request)
    {
        $request->validate([
            'password1' => 'required|min:8',
            'password2' => 'required',
        ]);
        if ($request->password1 != $request->password2) {
            return redirect('setting/' . $id)->with('error', 'Passwords do not match');
        }
        $user = User::find($id);
        $user->update([
            'password' => Hash::make($request->password1),
        ]);
        return redirect('setting/' . $id)->with('success', 'Password update successful');
    }

    public function updateCompany(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'vatno' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);
        $userCompany = UserCompany::first();

        if ($userCompany) {
            // Update the existing user company record
            $logo = $request->logo;
            if ($request->hasFile('logo')) {
                $logo = $request->name . '.' . $request->logo->extension();
                $request->logo->move(public_path('images'), $logo);
            }

            $userCompany->company_name = $request->name;
            $userCompany->address = $request->address;
            $userCompany->vat_no = $request->vatno;
            $userCompany->phone_number = $request->phone;
            $userCompany->logo_path = $logo;
            $userCompany->save();
        }

        return redirect()->back()->with('success', 'Company update successful');
    }
    public function addCompany(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'vatno' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);
        $logo = $request->logo;
        if ($request->hasFile('logo')) {
            $logo = $request->name . '.' . $request->logo->extension();
            $request->logo->move(public_path('images'), $logo);
        }

        $userCompany = new UserCompany;
        $userCompany->company_name = $request->name;
        $userCompany->address = $request->address;
        $userCompany->vat_no = $request->vatno;
        $userCompany->phone_number = $request->phone;
        $userCompany->logo_path = $logo;
        $userCompany->save();

        return redirect()->back()->with('success', 'Company created successfully');
    }
}
