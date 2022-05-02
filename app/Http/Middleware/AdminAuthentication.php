<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App;

class AdminAuthentication
{
    public function handle($request, Closure $next)
    {
        if(!Auth::guard('web')->check()) {
            return redirect()->route('manage.login');
        }
        return $next($request);
    }
}
