<?php

use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\EmailVerificationNotificationController;
use App\Http\Controllers\EmailVerificationPromptController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SendController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyEmailController;
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

Auth::routes();

Route::middleware('guest')->group(function ()
{
    Route::get('/signin', [UserController::class, 'signIn'])
        ->name('signin');
    Route::post('/signin', [UserController::class, 'login']);

    Route::get('/signup', [UserController::class, 'signUp'])
        ->name('signup');
    Route::post('/signup', [UserController::class, 'registrate']);
});


Route::middleware('auth')->group(function ()
{
    Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware('signed')
        ->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, '__invoke'])
        ->name('verification.send');

    Route::post('/file', [FileController::class, 'addFile'])
        ->name('add');
    Route::post('/download', [FileController::class, 'downloadFile'])
        ->name('download');

    Route::get('/directory/{id?}', [DirectoryController::class, 'openHomePage'])
        ->middleware('verified')
        ->name('main');
    Route::post('/directory', [DirectoryController::class, 'create'])
        ->name('directory');
});


Route::get('send/text', [SendController::class, 'sendText']);



