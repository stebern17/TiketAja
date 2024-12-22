<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function showRegisterForm()
    {
        return view('admin.auth.register');
    }

    public function login(Request $request)
    {
        $request->only('email_user', 'password');

        $user = User::where('email_user', $request->input('email_user'))
            ->orWhere('name_user', $request->input('email_user'))
            ->first();


        if ($user && hash::check($request->password, $user->password)) {
            Auth::login($user);
            return $this->redirectUserByRole('catalogue.index');
        }

        return back()->with('Email/Password salah');
    }

    public function redirectUserByRole($route)
    {
        switch (Auth::user()->role) {
            case 'Admin':
                return redirect()->route('admin.dashboard');
                break;
            case 'User':
                return redirect()->route('catalogue.index');
                break;
            default:
                return redirect()->route($route);
                break;
        }

        return redirect()->route($route);
    }

    public function register(Request $request)
    {

        $request->validate([
            'name_user' => 'required|string',
            'email_user' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'nullable|string',
        ]);


        $role = $request->role ?? 'user';


        $user = User::create([
            'name_user' => $request->name_user,
            'email_user' => $request->email_user,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);


        Auth::login($user);


        return $this->redirectUserByRole('catalogue.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('catalogue.index');
    }
}
