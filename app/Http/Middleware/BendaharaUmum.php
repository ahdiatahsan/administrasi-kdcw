<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BendaharaUmum
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
        if (!Auth::check()) {
            return redirect(404);
        }

        $activeUser = Auth::user();

        if ($activeUser->jabatan != 9) {
            return redirect()->route('keuangan.index')
            ->with('wrong_role', 'hanya untuk bendahara umum saja');
        }

        return $next($request);
    }
}
