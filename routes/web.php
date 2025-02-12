<?php

use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function(){
 return view('general-page');
});
Route::get('/register/customer', [AuthController::class, 'showCustomerRegistrationForm'])->name('register.customer');
Route::get('/register/admin', [AuthController::class, 'showAdminRegistrationForm'])->name('register.admin');

Route::post('/register/customer', [AuthController::class, 'registerCustomer']);
Route::post('/register/admin', [AuthController::class, 'registerAdmin']);

Route::get('/login/admin', [AuthController::class, 'showAdminLoginForm'])->name('login.admin');
Route::post('/login/admin', [AuthController::class, 'adminLogin'])->name('adminLogin');
Route::post('/check-email-exists', [AuthController::class, 'checkEmailExists'])->name('check.email.exists');
Route::get('/login', [AuthController::class, 'showCustomerLoginForm'])->name('login.customer');
Route::post('/login', [AuthController::class, 'customerLogin']);

Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    session()->flash('success', 'You are logged in as Admin');
    return view('dashboard');
})->name('dashboard');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Email Verification Routes
Route::get('/email/verify', function () {
    return view('verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('success', 'Verification email sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    $user = $request->user();

    // Redirect based on user role
    return redirect($user->role === 'customer' ? '/' : '/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');
