<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function profile()
    {
        return view('user.profile');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'min:6'],
            ]);
            if (Auth::guard('user')->attempt($data, $request->remember)) {
                $request->session()->regenerate();
                return redirect()->route('user.profile');
            }
        }
        return view('pages.login');
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {
            dd($request->all());
        }
        return view('pages.register');
    }
}
