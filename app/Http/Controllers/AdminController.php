<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    private const ADMIN_ID = 'admin01';
    private const ADMIN_PASSWORD = 'admin123';

    public function showLoginForm()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'admin_id' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if ($request->input('admin_id') === self::ADMIN_ID && $request->input('password') === self::ADMIN_PASSWORD) {
            session([
                'admin_logged_in' => true,
                'admin_id' => self::ADMIN_ID,
            ]);

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'login' => 'ID admin atau password salah.',
        ])->withInput();
    }

    public function dashboard()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        return view('admin.dashboard', [
            'adminId' => session('admin_id'),
        ]);
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_id']);

        return redirect()->route('admin.login');
    }
}
