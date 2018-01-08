<?php

namespace Matthewbdaly\LaravelBlog\Http\Middleware;

use Closure;

class AdminModelExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $model = $request->route('resource');
        if (!array_key_exists($model, config('admin.models'))) {
            abort(404);
        }
        return $next($request);
    }
}
