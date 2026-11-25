<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /**
     * Menampilkan halaman registrasi.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Memproses registrasi pembeli.
     */
    public function store(Request $request)
    {
        // 1. Validasi input registrasi
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'max:150',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // 2. Membuat user dan memberikan role pembeli
        $user = DB::transaction(function () use ($validated) {

            // Membuat akun user baru
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
            ]);

            // Mengambil role pembeli dari database
            $role = Role::where('name', 'pembeli')->firstOrFail();

            // Menambahkan role pembeli ke user
            $user->roles()->attach($role->id);

            return $user;
        });

        // 3. Login otomatis setelah registrasi
        Auth::login($user);

        // 4. Memperbarui session untuk keamanan
        $request->session()->regenerate();

        // 5. Redirect ke dashboard marketplace
        return redirect('/')
            ->with('success', 'Registrasi berhasil! Selamat datang.');
    }
}
