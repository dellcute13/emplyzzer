<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show Login Page
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Process Login
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:3',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {

            $request->session()->regenerate();

            return redirect()->route('dashboard')
                ->with('modal_success', 'Login berhasil masuk sistem.');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Optional Logout Page
     */
    public function logoutPage()
    {
        return redirect()->route('login');
    }
}
