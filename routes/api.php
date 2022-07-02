<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Sanctum middleware group
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/authenticated', static function () {
        return true;
    });

    // user
    Route::post('/user/post', [App\Http\Controllers\AccountController::class, 'storePost']);
    Route::get('/user/my-posts', [App\Http\Controllers\AccountController::class, 'myPosts']);

    // admin
    Route::get('/admin/posts/fetch', [App\Http\Controllers\AdminAccountController::class, 'fetchExternalPosts']);
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'login']);

});

// Register/Login
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])
    ->name('user.register');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])
    ->name('user.login');
