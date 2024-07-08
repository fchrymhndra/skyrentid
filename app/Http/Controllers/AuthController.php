<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\User;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Str;

// class AuthController extends Controller
// {
//     public function showLoginForm()
//     {
//         return view('auth.login');
//     }

//     public function showRegisterForm()
//     {
//         return view('auth.register');
//     }

//     public function register(Request $request)
//     {
//         $request->validate([
//             'nama' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users',
//             'password' => 'required|string|min:8|confirmed',
//             'no_hp' => 'required|string|max:15',
//         ]);

//         $user = User::create([
//             'nama' => $request->nama,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//             'no_hp' => $request->no_hp,
//             'role' => 'customer',
//             'remember_token' => Str::random(10),
//         ]);

//         return redirect()->route('login')->with('success', 'Registration successful. Please login.');
//     }

//     public function login(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|string|email',
//             'password' => 'required|string',
//         ]);

//         if (Auth::attempt($request->only('email', 'password'))) {
//             $request->session()->regenerate();

//             // Redirect based on role
//             if (Auth::user()->role === 'admin') {
//                 return redirect()->intended('dashboard');
//             } else {
//                 return redirect()->intended('beranda');
//             }
//         }

//         return back()->withErrors([
//             'email' => 'The provided credentials do not match our records.',
//         ])->onlyInput('email');
//     }

//     public function logout(Request $request)
//     {
//         Auth::logout();
//         $request->session()->invalidate();
//         $request->session()->regenerateToken();

//         return redirect('/');
//     }
// }

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'no_hp' => 'required|string|max:15',
        ]);

        // Ubah nomor telepon yang diawali dengan "0" menjadi "62"
        $no_hp = $request->no_hp;
        if (substr($no_hp, 0, 1) === '0') {
            $no_hp = '62' . substr($no_hp, 1);
        }

        $user = User::create([
            'id_member' => '1',
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $no_hp,
            'role' => 'customer',
            'remember_token' => Str::random(10),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Redirect based on role
            // if (Auth::user()->role === 'admin') {
            //     return redirect()->route('dashboard');
            // } else {
            //     return redirect()->route('beranda');
            // }
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            } elseif (Auth::user()->role === 'customer') {
                return redirect()->route('beranda');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
