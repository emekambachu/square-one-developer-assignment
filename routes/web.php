<?php

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

//Auth::routes();

// Home
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');
Route::get('/posts/recent', [App\Http\Controllers\HomeController::class, 'indexRecent'])
    ->name('home.recent');
Route::get('/post/{id}/{slug}', [App\Http\Controllers\HomeController::class, 'show'])
    ->name('show');

// Register/Login
Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])
    ->name('register');
Route::get('email/verify/{token}', [App\Http\Controllers\Auth\RegisterController::class, 'emailVerify'])
    ->name('email.verify');
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])
    ->name('login');
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/user/dashboard', [App\Http\Controllers\AccountController::class, 'index'])
    ->name('dashboard');
Route::get('/user/post/create', [App\Http\Controllers\AccountController::class, 'createPost'])
    ->name('user.post.create');

// Admin
Route::get('/admin/dashboard', [App\Http\Controllers\AdminAccountController::class, 'adminDashboard'])
    ->name('admin.dashboard')->middleware('admin');
Route::post('/admin/posts/fetch', [App\Http\Controllers\AdminAccountController::class, 'fetchExternalPosts'])
    ->name('admin.posts.fetch');

