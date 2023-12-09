<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateEmployee
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is logged in
        // if (!session()->has('employee_id')) {
        //     return redirect()->route('login')->withErrors(['message' => 'Unauthorized access. Please log in.']);
        // }

        return $next($request);
    }
}

