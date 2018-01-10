<?php

namespace Matthewbdaly\LaravelAdmin\Http\Middleware;

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
        $models = config('admin.models');
        if (!$models || !array_key_exists($model, $models)) {
            abort(404);
        }
        return $next($request);
    }
}
