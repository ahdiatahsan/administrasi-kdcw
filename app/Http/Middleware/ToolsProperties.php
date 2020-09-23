<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ToolsProperties
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
        $koordTools = $activeUser->jabatan == 14;
        $stafTools = $activeUser->jabatan == 15;

        if ($koordTools || $stafTools) {
            return $next($request);
        }

        return redirect()->route('barang.index')
        ->with('wrong_role', 'hanya untuk anggota divisi tools & properties');
    }
}
