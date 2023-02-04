<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Mail\PasswordResetMail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Testing route
Route::get('test', function () {
    return view('test');
});
Route::get('/', [LoginController::class, 'index'])->name('startingpoint');
Route::post('/login', [LoginController::class, 'Login'])->name('login');
Route::get('dashboard', [LoginController::class, 'dashboard'])->middleware('auth');

//Forget password routing code starts from here
Route::get('/forgetpassword', [ForgotPasswordController::class, 'forgetPassword']);
Route::post('/forgetpassword', [ForgotPasswordController::class, 'forgetPassword'])->name('ForgetPasswordPost');

Route::get('reset-password/{token}', [ForgotPasswordController::class, 'ResetPassword'])->name('ResetPasswordGet');

Route::post('reset-password', [ForgotPasswordController::class, 'ResetPasswordStore'])->name('ResetPasswordPost');
//Dashboard
// Route::get('dashboard', [DashboardController::class,'dashboard']);
//Parties route
Route::get('parties', [AccountController::class, 'partiesHandler'])->name('parties');
Route::get('addnewparty', [AccountController::class, 'addNewParty'])->name('addnewparty');
Route::get('cash', [AccountController::class, 'partiesCash'])->name('cash');
Route::get('parties/purchaserecord', [AccountController::class, 'partiesPurchase'])->name('ledgerpurchase');

Route::get('parties/{companyname}', [AccountController::class, 'viewLedger'])->name('viewLedger');



