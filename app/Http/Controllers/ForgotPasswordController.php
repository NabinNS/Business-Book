<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetMail;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
// use DB;
// use Mail;
// use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function forgetPassword(Request $request)
    {

        if ($request->isMethod('get')) {

            return view('auth.forget-password');
        }

        if ($request->isMethod('post')) {

            $request->validate([
                'email' => 'required|email|exists:users|unique:password_resets,email',
            ]);
            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            $user = User::firstWhere('email', $request->email);

            Mail::to($user->email)->send(new PasswordResetMail($token));
            return back()->with('message', 'We have e-mailed your password reset link!');
        }
    }
    public function ResetPassword($token)
    {
        return view('auth.reset-password-form', ['token' => $token]);
    }
    public function ResetPasswordStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token! for the given email address. Please check');
        }

        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        // Delete password_resets record
        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect('/')->with('message', 'Your password has been successfully changed!');
    }
}
