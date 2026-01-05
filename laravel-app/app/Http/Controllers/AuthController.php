<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session()->has('auth_user')) {
            return redirect()->route('beranda');
        }

        return view('auth.auth');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Use raw input values (stringable helpers would require explicit casting)
        $user = (string) $request->input('username');
        $pass = (string) $request->input('password');

        $expectedUser = config('app.admin_user', env('ADMIN_USER', 'admin'));
        $expectedPass = config('app.admin_password', env('ADMIN_PASSWORD', 'admin'));

        if ($user !== $expectedUser || $pass !== $expectedPass) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors(['username' => 'Username atau password salah.']);
        }

        $request->session()->put('auth_user', $user);
        $request->session()->regenerate();

        return redirect()->intended(route('beranda'));
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
