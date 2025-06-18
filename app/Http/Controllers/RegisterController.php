<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {

        $data = $request->validate([
            'login' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'full_name' => ['required', 'string', 'max:255', 'regex:/^[А-ЯЁа-яё\s\-]+$/u'],
            'phone' => ['required', 'string', 'digits:10'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $user = User::create($data);

        auth()->login($user);

        return redirect(route('home'));
    }
}
