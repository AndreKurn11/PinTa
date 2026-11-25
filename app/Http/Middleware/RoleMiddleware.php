<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Memeriksa apakah user memiliki role yang diizinkan.
     *
     * @param Request $request
     * @param Closure $next
     * @param string ...$roles
     * @return Response
     */
    public function handle(
        Request $request,
        Closure $next,
        string ...$roles
    ): Response {

        // 1. Mengambil user yang sedang login
        $user = $request->user();

        // 2. Memastikan user sudah login
        if (!$user) {
            return redirect()->route('login');
        }

        // 3. Memeriksa apakah user memiliki salah satu role
        foreach ($roles as $role) {

            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        // 4. Jika role tidak sesuai, tampilkan halaman 403
        abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
