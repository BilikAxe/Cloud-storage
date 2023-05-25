<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function signIn(): string
    {
        return view('login');
    }

    public function signUp(): string
    {
        return view('registration');
    }


}
