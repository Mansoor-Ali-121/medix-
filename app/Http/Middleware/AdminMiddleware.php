<?php

namespace App\Http\Middleware;

use Log;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
 
        if (Auth::check()) {
            $userType = Auth::user()->usertype;

            if ($userType === 'admin') {
                return $next($request);
            }
        }

        return redirect()->route('login')->with('error', 'Unauthorized Access');
    }
}
