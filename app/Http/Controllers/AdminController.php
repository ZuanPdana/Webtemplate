<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function loginFromMain(Request $request)
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

        return back()->withErrors([
            'login' => 'Username admin atau password salah.',
        ])->withInput();
    }

    public function dashboard()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('login');
        }

        return view('admin.dashboard', [
            'adminId' => session('admin_id'),
        ]);
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_id']);

        return redirect()->route('login');
    }
}
