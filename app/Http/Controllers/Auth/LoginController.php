<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Memproses login user.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
                'string',
            ],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // 2. Memeriksa email, password, dan status akun
        $authenticated = Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'status' => 'active',
        ]);

        // 3. Jika autentikasi gagal
        if (!$authenticated) {
            throw ValidationException::withMessages([
                'email' => 'Email atau password salah, atau akun tidak aktif.',
            ]);
        }

        // 4. Regenerasi session untuk keamanan
        $request->session()->regenerate();

        // 5. Redirect ke halaman sebelumnya atau dashboard
        return redirect()->intended('/')
            ->with('success', 'Login berhasil! Selamat datang kembali.');
    }

    /**
     * Memproses logout user.
     */
    public function destroy(Request $request)
    {
        // 1. Mengakhiri autentikasi user
        Auth::logout();

        // 2. Menghapus seluruh data session
        $request->session()->invalidate();

        // 3. Membuat token CSRF baru
        $request->session()->regenerateToken();

        // 4. Kembali ke dashboard publik
        return redirect('/')
            ->with('success', 'Kamu berhasil logout.');
    }
}