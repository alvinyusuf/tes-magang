<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationsController extends Controller
{
    public function indexRegister() {
        return view('authentications.register');
    }

    public function indexLogin() {
        return view('authentications.login');
    }

    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users|max:255',
            'role' => 'required',
            'password' => 'required',
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $insert = User::create($validated);
        return redirect('/login')->with('success', 'Akun berhasil dibuat');
    }

    public function login(Request $request) {
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($validatedData)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Login berhasil');
        }

        return redirect('/login')->with('fail', 'Username atau Password salah');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
