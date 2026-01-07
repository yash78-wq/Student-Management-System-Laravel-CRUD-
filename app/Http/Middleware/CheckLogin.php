<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLogin
{
    public function handle(Request $request, Closure $next)
    {
        // Middleware condition: check if login session exists
        if (!session()->has('loggedIn')) {
            return redirect('/login');
        }
        // Middleware condition: check if login session exists
        return $next($request);
    }
}
    