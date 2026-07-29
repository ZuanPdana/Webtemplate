<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminBaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!session('admin_logged_in')) {
                return redirect()->route('admin.login');
            }

            return $next($request);
        });
    }
}
