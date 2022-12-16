<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Hash;

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
                return redirect('/');
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
            $data = $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'min:6'],
            ]);

            if ($request->password != $request->confirm_password) {
                return redirect()->back()->with('confirm_password', 'Password not confirm');
            }

            // Create user
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $user->save();

            // Login new account
            auth('user')->attempt(['email' => $data['email'], 'password' => $data['password']], true);
            $request->session()->regenerate();

            return redirect()->route('user.profile');
        }
        return view('pages.register');
    }
}
