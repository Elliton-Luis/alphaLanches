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
use App\Http\Controllers\GuardRequestController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PDVController;
use App\Http\Middleware\VerifyAuthAdmin;

Route::prefix('responsaveis')->middleware(VerifyAuthAdmin::class)->group(function () {
    Route::get('/', [GuardRequestController::class, 'guardConfirm'])->name('guardRequests.index');
    Route::get('/{id}', [GuardRequestController::class, 'acceptRequest'])->name('guardRequests.accept');
    Route::post('/rejeitado/{id}', [GuardRequestController::class, 'rejectRequest'])->name('guardRequests.reject');
});

Route::get('/home', [HomeController::class, 'showHome'])->name('home')->middleware();

Route::get('/', [LoginController::class, 'showLogin'])->name('login');
Route::post('/auth', [LoginController::class, 'authUser'])->name('login.auth');
Route::post('/logout', [LoginController::class, 'logoutUser'])->name('login.logout');
Route::get('/cadastro', [LoginController::class, 'showCadastro'])->name('login.cadastro');
Route::post('/store', [LoginController::class, 'storeUser'])->name('login.store');

Route::prefix('senha')->group(function () {
    Route::get('resetar', [PasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('email', [PasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('resetar/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('resetar', [PasswordController::class, 'reset'])->name('password.update');
});

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

Route::get('/financeiro', [FinanceiroController::class, 'showFinanceiro'])->name('financeiro');
Route::get('/painelUsuarios', [CreateUserController::class, 'showPainelUsuarios'])->name('painel.usuarios');
Route::get('/painelCompras', [CreateUserController::class, 'showPainelCompras'])->name('painel.compras');


Route::prefix('pdv')->group(function () {
    Route::get('/', [PDVController::class, 'index'])->name('pdv.index');
    Route::get('/searchUser', [PDVController::class, 'searchUser'])->name('searchUser');
    Route::post('/store', [PDVController::class, 'store'])->name('pdv.store');
    Route::post('/repor', [PDVController::class, 'reporEstoque'])->name('repor');
});
