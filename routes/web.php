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
use App\Http\Controllers\PedidosReservadosController;
use App\Http\Middleware\VerifyAuthAdmin;

Route::get('/home', [HomeController::class, 'showHome'])->name('home')->middleware('auth');

Route::prefix('responsaveis')->middleware(VerifyAuthAdmin::class)->group(function () {
    Route::get('/', [GuardRequestController::class, 'guardConfirm'])->name('guardRequests.index');
    Route::get('/{id}', [GuardRequestController::class, 'acceptRequest'])->name('guardRequests.accept');
    Route::post('/rejeitado/{id}', [GuardRequestController::class, 'rejectRequest'])->name('guardRequests.reject');
});

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

Route::prefix('estoque')->middleware(VerifyAuthAdmin::class)->group(function () {
    Route::get('/', [EstoqueController::class, 'index'])->name('estoque.index');
    Route::post('/update-stock/{id}', [EstoqueController::class, 'updateStock'])->name('estoque.updateStock');
    Route::post('/update-value/{id}', [EstoqueController::class, 'updateValue'])->name('estoque.updateValue');
    Route::get('/edit/{id}', [EstoqueController::class, 'edit'])->name('estoque.edit');
    Route::post('/update/{id}', [EstoqueController::class, 'update'])->name('estoque.update');
    Route::delete('/delete/{id}', [EstoqueController::class, 'destroy'])->name('estoque.destroy');
});

Route::prefix('recarga')->middleware(VerifyAuthAdmin::class)->group(function () {
    Route::get('/', [RecargaController::class, 'index'])->name('recarga.index');
});

Route::middleware(['auth'])->prefix('recargaCliente')->group(function () {
    Route::get('/', [RecargaClienteController::class, 'index'])->name('recargaCliente.index');
});

Route::get('/create/user', [CreateUserController::class, 'showIndex'])->name('create.user.index')->middleware(verifyAdmin::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/agendamento', [AgendamentoController::class, 'index'])->name('agendamento.index');
    Route::post('/agendamento', [AgendamentoController::class, 'store'])->name('agendamento.store');
    Route::get('/agendamento/search-user', [AgendamentoController::class, 'searchUser'])->name('agendamento.searchUser');
    Route::patch('/agendamento/{id}/cancelar', [AgendamentoController::class, 'cancelar'])->name('agendamento.cancelar');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/pedidosReservados', [PedidosReservadosController::class, 'index'])->name('pedidosReservados.index');
    Route::patch('/pedidosReservados/{id}/concluir', [PedidosReservadosController::class, 'concluir'])->name('pedidosReservados.concluir');
});

Route::middleware(VerifyAuthAdmin::class)->prefix('financeiro')->group(function () {
    Route::get('/', [FinanceiroController::class, 'index'])->name('financeiro');
    Route::get('/relatorio', [FinanceiroController::class, 'exportarPDF'])->name('relatorio');
});

Route::get('/painelUsuarios', [CreateUserController::class, 'showPainelUsuarios'])->middleware(VerifyAuthAdmin::class)->name('painel.usuarios');
Route::get('/painelStudents', [CreateStudentController::class, 'showPainelStudents'])->middleware(['auth'])->name('painel.students');

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

    Route::middleware('admin')->group(function () {
        Route::get('/relatorio-vendas', [HistoricoController::class, 'relatorio'])->name('historico.relatorio');
    });

});
