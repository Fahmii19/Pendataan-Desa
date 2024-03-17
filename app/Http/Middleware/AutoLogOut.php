<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AutoLogOut
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
        if (now()->diffInMinutes(session('last_login')) >= (int)env('TIMEOUT_LOGIN', 30)) {  // also you can this value in your config file and use here
            if (auth()->check() && auth()->id() > 1) {
                auth()->logout();


                session()->forget('last_login');

                return redirect("/login");
            }
        }

        return $next($request);
    }
}
