<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email'=>['required','email'],
            'password'=>['required', 'string']
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            if (
                $user->hasAllRoles(['reporter', 'admin']) ||
                $user->hasAllRoles(['reporter', 'creator'])
            ) {
                return redirect()->route('posts.index');
            }

            return redirect()
                ->route('home')
                ->with('info', 'شما وارد حساب کاربری خود شدید، اما دسترسی به پنل مدیریت مطالب را ندارید.');
        }
        return back()->withErrors([
            'email' => 'ایمیل یا رمز عبور اشتباه است.',
        ])->onlyInput('email');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
