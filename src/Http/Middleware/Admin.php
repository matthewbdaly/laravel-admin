<?php

namespace Matthewbdaly\LaravelAdmin\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;

use Closure;

class Admin
{
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$user = $this->auth->user()) {
        }
        return $next($request);
    }
}
