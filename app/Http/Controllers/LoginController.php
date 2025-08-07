<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\KaryawanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->route('login')
                            ->with('error', 'Email tidak terdaftar.');
        }
        if (!Auth::attempt($credentials, $request->filled('remember'))) {
            return redirect()->route('login')
                            ->with('error', 'Password salah.');
        }
        $request->session()->regenerate();

        return redirect()->route('admin_dashboard')->with('success', 'Berhasil login!');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('pasien.index');
    }
}
