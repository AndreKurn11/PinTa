<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Memproses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Memeriksa email dan password
        if (Auth::attempt($credentials)) {
            // Regenerasi session
            $request->session()->regenerate();

            // Mengambil role user
            $role = Auth::user()->role->name ?? null;

            // Redirect berdasarkan role
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($role === 'pengunjung') {
                return redirect()->route('pengunjung.dashboard');
            }

            if ($role === 'pembeli') {
                return redirect()->route('pembeli.dashboard');
            }

            if ($role === 'penjual') {
                return redirect()->route('penjual.dashboard');
            }

            // Jika role tidak dikenali
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Role akun tidak valid.',
                ]);
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}