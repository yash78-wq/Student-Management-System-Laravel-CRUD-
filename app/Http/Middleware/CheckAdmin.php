<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Only admin can access teacher routes
        if (session('role') !== 'admin') {
            return redirect('/students')->with('error', 'Access Denied! Admin Only');
        }

        return $next($request);
    }
}
