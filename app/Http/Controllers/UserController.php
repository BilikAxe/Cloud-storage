<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use App\Services\RabbitMQService;
use Illuminate\Auth\Events\Registered;
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


    /**
     * @throws \Exception
     */
    public function registrate(SignUpRequest $request): RedirectResponse
    {
        $user = User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'user_name' => $request->get('user_name'),
            'email' => $request->get('email'),
            'phone_number' => $request->get('phone_number'),
            'password' => Hash::make($request->get('password')),
        ]);

        $message = "Сообщение отправленно на почту.";
        $mqService = new RabbitMQService();
        $mqService->publish($message);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('main');
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
