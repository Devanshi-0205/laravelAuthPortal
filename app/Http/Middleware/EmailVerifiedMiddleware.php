<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EmailVerifiedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and their email is verified
        if (Auth::check() && Auth::user()->email_verified_at !== null) {
            return $next($request);
        }

        // Redirect to the registration form if email is not verified
        return redirect('/register')->with('error', 'Please verify your email before accessing this page. Check your mail for verification', 401);
    }
}
