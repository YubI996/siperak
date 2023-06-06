<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class QRMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() !== NULL && $request->user()->role_id == 8) {
                return $next($request);
        }
        else {
            return redirect()->route('recipients.profil',$request->route('slug'));
        }
    }
}
