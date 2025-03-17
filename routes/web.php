<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\verifyAdmin;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EstoqueController;

Route::get('/home', [HomeController::class, 'showHome'])->name('home.index');

Route::get('/', [LoginController::class, 'showLogin'])->name('login');
Route::post('/auth', [LoginController::class, 'authUser'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logoutUser'])->name('login.logout');
Route::get('/cadastro',[LoginController::class, 'showCadastro'])->name('login.cadastro');
Route::post('/store',[LoginController::class,'storeUser'])->name('login.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
});

Route::prefix('estoque')->group(function () {
    Route::get('/', [EstoqueController::class, 'index'])->name('estoque.index');
    Route::post('/store', [EstoqueController::class, 'store'])->name('estoque.store');
    Route::post('/update-stock/{id}', [EstoqueController::class, 'updateStock'])->name('estoque.updateStock');
    Route::post('/update-value/{id}', [EstoqueController::class, 'updateValue'])->name('estoque.updateValue');
});

Route::get('/create/user', [CreateUserController::class, 'showIndex'])->name('create.user.index')->middleware(verifyAdmin::class);