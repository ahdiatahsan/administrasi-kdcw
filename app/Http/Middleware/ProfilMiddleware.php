<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ProfilMiddleware
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

        if ($activeUser->id != $request->route('profil')) {
            return redirect()->route('profil.index')
            ->with('wrong_role', 'bukan merupakan halaman profil Anda');;
        }

        return $next($request);
    }
}
