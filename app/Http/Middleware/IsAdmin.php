<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->is_admin == 1) {

            $role = $request->route()->getAction()['role'];

            if ($role == 'admin' || Auth::user()->$role) {
                return $next($request);
            }
            return back()->with('error', 'Unauthorized');
        }

        return redirect()->route('home')->with('error', 'You are not an admin');
    }
}
