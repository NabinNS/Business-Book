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
  
}
