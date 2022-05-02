<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App;

class UserAuthentication
{
    public function handle($request, Closure $next)
    {
        if(!Auth::guard('web')->check()) {
            return redirect()->route('staff.login');
        }
        return $next($request);
    }
}
