<?php

namespace App\Http\Middleware;

use Closure;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class EmployeeExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check())
        {
                abort_unless(Auth::user()->employee, 403, 'You are not allowed to access Opscore! Missing matching employee record');
                return $next($request);
        }
        else{
            return Redirect::route('login')->with('error', 'Login to access Opscore');
        }
    }
}