<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PublicRelation
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
        $koordPR = $activeUser->jabatan == 12;
        $stafPR = $activeUser->jabatan == 13;

        if ($koordPR || $stafPR) {
            return $next($request);
        }

        return redirect()->route('relasi.index')
        ->with('wrong_role', 'hanya untuk anggota divisi public & relation');
    }
}
