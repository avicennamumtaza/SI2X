<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsRw
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Memeriksa peran pengguna
        if (!auth()->check() || auth()->guest() || auth()->user()->role !== 'Rw') {
            // Jika peran pengguna bukan 'rw', munculkan error 403
            abort(403);
        }
        return $next($request);
    }
}
