<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller as BaseController;

class LoginController extends BaseController
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = 'admin@example.com';
        $password = 'password123';

        if (
            $request->email === $email &&
            $request->password === $password
        ) {
            Session::put('logged_in', true);
            Session::put('user_email', $request->email);

            return redirect()
                ->route('tasks.index')
                ->with('success', 'Welcome back! You are now logged in.');
        }

        return back()
            ->withErrors([
                'email' => 'Invalid email or password.',
            ])
            ->withInput();
    }

    public function logout()
    {
        Session::forget('logged_in');
        Session::forget('user_email');

        return redirect()
            ->route('login')
            ->with('success', 'You have been logged out.');
    }
}