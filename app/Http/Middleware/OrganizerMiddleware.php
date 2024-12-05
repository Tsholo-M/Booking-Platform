<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class OrganizerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
  public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Allow only users with 'organizer' role to proceed, others should be redirected
        if ($user && $user->role !== 'organizer') {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to access this page.');
        }

        return $next($request);
    }
  
      

       
}
