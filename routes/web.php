<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FileController;
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

Route::get('/signin', [UserController::class, 'signIn'])->name('signin');
Route::get('/signup', [UserController::class, 'signUp'])->name('signup');
Route::get('/file', [FileController::class, 'openHomePage'])->middleware('auth')->name('main');
Route::post('/storage', [FileController::class, 'openFile'])->middleware('auth')->name('open');

Route::post('/signup', [UserController::class, 'registrate']);
Route::post('/signin', [UserController::class, 'login']);
Route::post('/file', [FileController::class, 'addFile'])->middleware('auth')->name('add');


