<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(auth()->check());

        if (Auth::check()) {
            return $next($request);
        }
        else{
            return view('auth/login');
        }  

        // if ($request->input('token') !== 'my-secret-token') {
        //     return redirect('home');
        // }
        // return $next($request);
    }
}
