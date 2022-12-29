<?php

namespace App\Http\Controllers;

use App\Mail\MailResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use Hash;
use Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
                'email' => ['required', 'email', 'exists:table,column'],
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

        // $request->session()->invalidate();

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

            return redirect('/');
        }
        return view('pages.register');
    }

    public function forgotPassword(Request $request)
    {
        if ($request->isMethod('POST')) {

            $data = $request->validate([
                'email' => ['required', 'email', 'exists:users,email']
            ]);

            $data['token'] = Str::random(64);

            $resetPassword = DB::table('password_resets')->insert([
                'email' => $data['email'],
                'token' => $data['token'],
                'created_at' => now()
            ]);

            if ($resetPassword) {
                Mail::to($data['email'])->send(new MailResetPassword($data));
                Alert::success('Thành Công!', 'Kiểm tra Email để thực hiện đổi mật khẩu');
                return redirect()->back();
            }

            Alert::error('Thất Bại!', 'Không thể đổi mật khẩu. Vui lòng thử lại sau!!!');
            return redirect()->back();
        }

        return view('pages.forgot_password');
    }

    public function resetPassword(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'min:6'],
            ]);

            $data['token'] = $request->token;

            $checkToken = DB::table('password_resets')->where([
                'email' => $data['email'],
                'token' => $data['token']
            ])->first();

            if (!$checkToken) {
                Alert::error('Lỗi', 'Token hoặc Email không hợp lệ');
                return redirect()->back();
            } else {
                User::where('email', $data['email'])->update([
                    'password' => Hash::make($data['password']),
                ]);

                DB::table('password_resets')->where('email', $data['email'])->delete();

                return redirect()->route('login');
            }
        }
        return view('pages.reset_password', ['token' => $request->token, 'email' => $request->email]);
    }
}
