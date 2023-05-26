<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/signin', [UserController::class, 'signIn'])->middleware('guest')->name('signin');
Route::get('/signup', [UserController::class, 'signUp'])->middleware('guest')->name('signup');
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::post('/signup', [UserController::class, 'registrate'])->middleware('guest');;
Route::post('/sigin', [UserController::class, 'login'])->middleware('guest');
