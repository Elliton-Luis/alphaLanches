<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\verifyAdmin;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\HomeController;

Route::get('/home', [HomeController::class, 'showHome'])->name('home.index');

Route::get('/', [LoginController::class, 'showLogin'])->name('login.index');
Route::post('/auth', [LoginController::class, 'authUser'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logoutUser'])->name('login.logout');

Route::get('/create/user', [CreateUserController::class, 'showIndex'])->name('create.user.index')->middleware(verifyAdmin::class);


