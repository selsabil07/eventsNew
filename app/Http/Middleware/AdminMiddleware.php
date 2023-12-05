<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     if (Auth::user()->admin) {
    //        return $next($request);
    //     }
    //     abort(Response::HTTP_FORBIDDEN);
    // }  

//     public function handle($request, Closure $next)
// {
//     if (Auth::user() && Auth::user()->admin == 1) {
//         return $next($request);
//     }

//     return abort(Response::HTTP_FORBIDDEN);
// }
public function handle(Request $request, Closure $next): Response
{
    $user = Auth::user();

    // Check if a user is authenticated and if they have the 'admin' property.
    if ($user && $user->admin) {
        return $next($request);
    }

    // If the user is not an admin or not authenticated, you might want to redirect or return a response.
    // For example, redirect to the home page:
    return abort(Response::HTTP_FORBIDDEN);
}
}
