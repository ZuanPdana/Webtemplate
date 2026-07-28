<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $admin = Admin::where('username', $request->input('login'))->first();

        if ($admin && Hash::check($request->input('password'), $admin->password)) {
            session([
                'admin_logged_in' => true,
                'admin_id' => $admin->username,
            ]);

            return redirect()->route('admin.dashboard');
        }

        $field = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$field => $request->input('login'), 'password' => $request->input('password')], $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('shop.home'));
        }

        return back()->withErrors([
            'login' => 'Username/email atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('portal');
    }
}
