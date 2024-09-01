<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // ignore access to login page
        if ($request->path() == 'admin/login' && $user) {   
            dd($user);
            if ($user->role_id == 1)
                return redirect('/admin');
            return redirect('/');
        }
        else if (!$user) {
            return redirect(route('login'));
        }

        return $next($request);
    }
}
