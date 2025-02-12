<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionTimeout{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle($request, Closure $next)
    {

        if (session()->has('user')) {
            session()->flush();
            return redirect('/')->with('timeoutMessage', 'Your session has expired. Please log in again.');
        }


        return $next($request);
    }
  
}
