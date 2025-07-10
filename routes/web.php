<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\verifyAdmin;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\CreateStudentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\RecargaController;
use App\Http\Controllers\GuardRequestController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\HistoricoRecargaController;
use App\Http\Controllers\PDVController;
use App\Http\Controllers\RecargaClienteController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\HistoricoController;
use App\Http\Middleware\VerifyAuthAdmin;

Route::get('/home', [HomeController::class, 'showHome'])->name('home')->middleware('auth');

Route::prefix('responsaveis')->middleware(VerifyAuthAdmin::class)->group(function () {
    Route::get('/', [GuardRequestController::class, 'guardConfirm'])->name('guardRequests.index');
    Route::get('/{id}', [GuardRequestController::class, 'acceptRequest'])->name('guardRequests.accept');
    Route::post('/rejeitado/{id}', [GuardRequestController::class, 'rejectRequest'])->name('guardRequests.reject');
});

Route::prefix('auth')->controller(LoginController::class)->group(function () {
    Route::get('/', 'showLogin')->name('login');
    Route::post('/login', 'authUser')->name('login.auth');
    Route::post('/logout', 'logoutUser')->name('login.logout');
    Route::get('/cadastro', 'showCadastro')->name('login.cadastro');
    Route::post('/store', 'storeUser')->name('login.store');
});

Route::prefix('senha')->group(function () {
    Route::get('resetar', [PasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('email', [PasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('resetar/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('resetar', [PasswordController::class, 'reset'])->name('password.update');
});

Route::middleware(['auth'])->controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/update', 'update')->name('update');
    Route::delete('/delete', 'delete')->name('delete');
});

Route::prefix('estoque')->middleware(VerifyAuthAdmin::class)->group(function () {
    Route::get('/', [EstoqueController::class, 'index'])->name('estoque.index');
});

Route::prefix('recarga')->middleware(VerifyAuthAdmin::class)->group(function () {
    Route::get('/', [RecargaController::class, 'index'])->name('recarga.index');
});

Route::middleware(['auth'])->prefix('recargaCliente')->group(function () {
    Route::get('/', [RecargaClienteController::class, 'index'])->name('recargaCliente.index');
});

Route::middleware(['verifyAdmin'])->prefix('create/user')->group(function () {
    Route::get('/', [CreateUserController::class, 'showIndex'])->name('create.user.index');
});

Route::get('/painelUsuarios', [CreateUserController::class, 'showPainelUsuarios'])->middleware(VerifyAuthAdmin::class)->name('painel.usuarios');

Route::get('/painelStudents', [CreateStudentController::class, 'showPainelStudents'])->middleware(['auth'])->name('painel.students');

Route::middleware(['auth'])->prefix('agendamento')->controller(AgendamentoController::class)->name('agendamento.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('/search-user', 'searchUser')->name('searchUser');
    Route::patch('/{id}/cancelar', 'cancelar')->name('cancelar');
});

Route::middleware(VerifyAuthAdmin::class)->prefix('financeiro')->group(function () {
    Route::get('/', [FinanceiroController::class, 'index'])->name('financeiro');
    Route::get('/relatorio', [FinanceiroController::class, 'exportarPDF'])->name('relatorio');
});

Route::middleware(VerifyAuthAdmin::class)->prefix('pdv')->group(function () {
    Route::get('/', [PDVController::class, 'index'])->name('pdv.index');
    Route::post('/repor', [PDVController::class, 'reporEstoque'])->name('repor');
});

Route::middleware(VerifyAuthAdmin::class)->group(function () {
    Route::get('/historicoRecarga', [HistoricoRecargaController::class, 'index'])->name('historicoRecarga.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/historico', [HistoricoController::class, 'index'])->name('historico.index');
    Route::get('/historico/{id}', [HistoricoController::class, 'show'])->name('historico.show');
    Route::get('/meu-historico', [HistoricoController::class, 'meuHistorico'])->name('historico.meu');
});
