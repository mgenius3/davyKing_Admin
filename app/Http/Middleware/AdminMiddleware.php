<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        //check if the admin has logged in
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }
        return response()->json(['message' => 'Access Denied'], 403);
    }
}
