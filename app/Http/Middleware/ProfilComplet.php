<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ProfilComplet
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	//dd($droit);

        if (! $request->user()->nom) {
            return redirect('/profil?r=' . rawurlencode($request->url()));
        }

        return $next($request);
    }
}
