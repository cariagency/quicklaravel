<?php

namespace App\Http\Middleware;

use Closure;

class AdminUser {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        // Restrict access to active users.
        if (!user()->itype === 'admin') {
            abort(403);
        }

        // If everything is ok, continue.
        return $next($request);
    }

}
