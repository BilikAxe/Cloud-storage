<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function signUp(): Factory|View|Application
    {
        return view('signup');
    }


    public function registrate(SignUpRequest $request): RedirectResponse
    {
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


    public function login(SignInRequest $request): RedirectResponse
    {
        if (!Auth::attempt($request->validated())){
            return back()
                ->withInput()
                ->withErrors([
                    'user_name'=> 'Invalid username or password.',
                ]);
        }

        return redirect()->route('main');
    }
}
