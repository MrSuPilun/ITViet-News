<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.admin_dashboard', ['profile' => auth('admin')->user()]);
    }

    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'min:6', 'max:20']
            ]);
            if (Auth::guard('admin')->attempt($data, $request->remember)) {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }
            return redirect()->back();
        }
        return view('admin.admin_login');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        // $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
