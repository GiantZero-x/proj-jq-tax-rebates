<?php

namespace App\Http\Middleware;

use Closure;

class RejectEmptyValues
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
        $params = collect($request)->map(function ($item) {
            return (null === $item) ? '' : trim($item);
        });

        $request->replace($params->all());

        return $next($request);
    }
}
