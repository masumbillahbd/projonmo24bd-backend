<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }

    public function handle($request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'editor' || Auth::user()->role == 'user' || Auth::user()->role == 'manager admin')) {
            return $next($request);
        }
        else{
            // abort(404);
            return redirect(route('login'));
        }
    }
}
