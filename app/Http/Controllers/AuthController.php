<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    // Show Customer Registration Form
    public function showCustomerRegistrationForm()
    {
        return view('register-customer');
    }

    // Show Admin Registration Form
    public function showAdminRegistrationForm()
    {
        return view('register-admin');
    }

    // Register Customer
    public function registerCustomer(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        event(new Registered($user));

        return redirect()->route('verification.notice');
    }

    // Register Admin
    public function registerAdmin(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        event(new Registered($user));

        return redirect()->route('verification.notice');
    }

    // Show Admin Login Form
    public function showAdminLoginForm()
    {
        return view('login-admin');
    }

    // Admin Login
    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->role !== 'admin') {
            return back()->withErrors(['You are not allowed to login as customer.']);
        }

        if (!$user->hasVerifiedEmail()) {
            return back()->withErrors(['error' => 'Please verify your email before logging in.']);
        }

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['error' => 'Invalid credentials']);
    }

    // Show Customer Login Form
    public function showCustomerLoginForm()
    {
        return view('login-customer');
    }

    // Customer Login
    public function customerLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user->hasVerifiedEmail()) {
            return back()->withErrors(['error' => 'Please verify your email before logging in.']);
        }

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['error' => 'Invalid credentials']);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logged out successfully');
    }


    public function checkEmailExists(Request $request)
    {
        $emailExists = User::where('email', $request->email)->exists();

        return response()->json(! $emailExists);
    }
}
