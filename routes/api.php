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

    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'login']);

});

// Register/Login
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create']);
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
