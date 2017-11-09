<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PossedeDroit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $droit)
    {
    	//dd($droit);

        if (! $request->user()->possedeDroit($droit)) {
            return redirect(action('IndexController@restreint'));
        }

        return $next($request);
    }
}
