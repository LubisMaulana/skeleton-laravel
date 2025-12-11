<?php
namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function pageLogin()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $request->validated();

        $credentials = [
            'email'    => $request->username,
            'password' => $request->password,
        ];

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->with('errorMsg', 'Email dan password salah.')->withInput();
        }

        $request->session()->regenerate();

        return redirect()->intended(route('home'))->with('successMsg', 'Selamat datang ' . Auth::user()->name . '.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('successMsg', 'Logout berhasil.');
    }
}
