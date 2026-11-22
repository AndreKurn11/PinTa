<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(
        Request $request,
        Closure $next,
        ...$roles
    ): Response {

        // Memastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Mengambil role user yang sedang login
        $userRole = Auth::user()->role->name ?? null;

        // Memeriksa apakah role user diizinkan
        if (!$userRole || !in_array($userRole, $roles, true)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Jika role sesuai, lanjutkan request
        return $next($request);
    }
}