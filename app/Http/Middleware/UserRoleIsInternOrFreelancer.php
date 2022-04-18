<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class UserRoleIsInternOrFreelancer
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
        return $this->isInternOrFreelancer() ? $next($request) : abort(403);
    }

    private function isInternOrFreelancer() {
        return Auth::user()->user_type_id == 2;
    }
}
