<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class UserRoleIsSupervisor
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
        return $this->isUserSupervisor() ? $next($request) : abort(403);
    }

    private function isUserSupervisor() {
        return Auth::user()->user_type_id != 2 ;
    }
}
