<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // $credentials = $request->validate([
        //     'email' => ['required'],
        //     'password' => ['required'],
        // ]);

        // $user = User::where('email',$request->email)->first();
        // if($user && $user->active == '1'){
        //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        //         $request->session()->regenerate();

        //         return redirect()->intended('dashboard');
        //     } else {
        //         return redirect('login')->with('login','false');
        //     }
        // } else {
        //     return redirect('login')->with('login','not_found');
        // }
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt login with active account only
        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'active' => 1
        ])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        // Login failed
        return redirect()->route('login')->with('login', 'invalid');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
