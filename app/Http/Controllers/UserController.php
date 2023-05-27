<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function signUp(): Factory|View|Application
    {
        return view('signup');
    }


    public function registrate(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'user_name' => 'required|min:2|unique:users',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|string',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect()->route('signin');
    }


    public function signIn(): Factory|View|Application
    {
        return view('signin');
    }


    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string',
        ]);
        if (!Auth::attempt($credentials)){
            return back()
                ->withInput()
                ->withErrors([
                    'user_name'=> 'Invalid username or password.',
                ]);
        }

        return redirect()->route('main');
    }
}
