<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\verifyAdmin;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

Route::get('/home', [HomeController::class, 'showHome'])->name('home.index');

Route::get('/', [LoginController::class, 'showLogin'])->name('login');
Route::post('/auth', [LoginController::class, 'authUser'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logoutUser'])->name('login.logout');

#Rota para a tela de perfil do usuário
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/create/user', [CreateUserController::class, 'showIndex'])->name('create.user.index')->middleware(verifyAdmin::class);


