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
        $user = $this->auth->user();
        if (!$user || !$user->isAdmin()) {
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
