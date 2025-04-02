<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\verifyAdmin;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\RecargaController;

Route::prefix('home')->middleware('auth')->group(function () {
    Route::get('/admin', [HomeController::class, 'homeAdmin'])->name('home.admin');
    Route::get('/func', [HomeController::class, 'homeFunc'])->name('home.func');
    Route::get('/student', [HomeController::class, 'homeStudent'])->name('home.student');
    Route::get('/guard', [HomeController::class, 'homeGuard'])->name('home.guard');
});

Route::get('/', [LoginController::class, 'showLogin'])->name('login');
Route::post('/auth', [LoginController::class, 'authUser'])->name('login.auth');
Route::post('/logout', [LoginController::class, 'logoutUser'])->name('login.logout');
Route::get('/cadastro', [LoginController::class, 'showCadastro'])->name('login.cadastro');
Route::post('/store', [LoginController::class, 'storeUser'])->name('login.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/remove-picture', [ProfileController::class, 'removePicture'])->name('profile.removePicture');
    Route::post('/profile/delete', [ProfileController::class, 'delete'])->name('profile.delete');
});

Route::prefix('estoque')->group(function () {
    Route::get('/', [EstoqueController::class, 'index'])->name('estoque.index');
    Route::post('/store', [EstoqueController::class, 'store'])->name('estoque.store');
    Route::post('/update-stock/{id}', [EstoqueController::class, 'updateStock'])->name('estoque.updateStock');
    Route::post('/update-value/{id}', [EstoqueController::class, 'updateValue'])->name('estoque.updateValue');
});

Route::prefix('recarga')->group(function () {
    Route::get('/', [RecargaController::class, 'index'])->name('recarga.index');
    Route::post('/process', [RecargaController::class, 'process'])->name('recarga.process');
});

Route::get('/create/user', [CreateUserController::class, 'showIndex'])->name('create.user.index')->middleware(verifyAdmin::class);

Route::get('/financeiro', [FinanceiroController::class, 'showFinanceiro'])->name('financeiro.index');

