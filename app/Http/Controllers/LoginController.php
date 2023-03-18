<?php

namespace App\Http\Controllers;

class LoginController extends Controller
{
    public function show()
    {
        return view("auth.login");
    }

    public function login()
    {

        $success = auth()->attempt([
            'email' => request('email'),
            'password' => request('password')
        ], request()->has('remember'));

        if ($success) {
            return redirect()->to('articles');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);

    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
