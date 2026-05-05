<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function viewLogin()
    {
        return view('auth.login');
    }

    /**
     * Menangani permintaan autentikasi.
     */
    public function storeLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Cek role untuk redirect (opsional, tergantung kebutuhan)
            return match($user->role) {
                'admin'   => redirect()->route('dashboard.admin'),
                default   => redirect()->intended('/dashboard'),
            };
        }

        return back()->withErrors([
            'email' => 'email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Menangani permintaan logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
