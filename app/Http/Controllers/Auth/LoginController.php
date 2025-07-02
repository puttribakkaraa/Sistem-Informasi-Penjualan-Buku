<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan form login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login pengguna.
     */
    public function login(Request $request)
{
    // Validasi input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    // Proses login
    if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();

        // Ambil user yang sedang login
        $user = Auth::user();

        // Redirect berdasarkan role
        if ($user->role === 'owner') {
            return redirect()->intended('/dashboardowner');
        } elseif ($user->role === 'admin') {
            return redirect()->intended('/HomeAdmin');
        } else {
            return redirect()->intended('/Home');
        }
    }

    // Jika login gagal
    return back()->withErrors(['email' => 'Email atau password salah.']);
}


    /**
     * Logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}

