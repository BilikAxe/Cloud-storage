<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function signUp()
    {
        return view('signup');
    }


    public function registrate(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'user_name' => 'required|min:2|unique:users',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|int',
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


    public function signIn()
    {
        return view('signin');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_name' => 'required|string|min:2',
            'password' => 'required|min:8',
        ]);
        if (!Auth::attempt($credentials)){
            return back()
                ->withInput()
                ->withErrors([
                    'user_name'=> 'Invalid username or password.',
                    'password' => 'Invalid username or password.',
                ]);
        }
        return redirect()->route('home');
    }
}
