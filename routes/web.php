<?php

use App\Http\Controllers\CartaoController;
use App\Http\Controllers\ClienteController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LojaController;
use App\Http\Controllers\PacotesController;
use App\Http\Controllers\PdvController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('pacotes')->group(function () {

    Route::get('/', [PacotesController::class, 'index'])->name('pacotes.index');
    Route::get('/novo-pacote', [PacotesController::class, 'create'])->name('pacotes.create');
    Route::get('/gerar-cartoes', [PacotesController::class, 'geraCartoes'])->name('pacotes.gera-cartoes');
    Route::post('/gerar-cartoes', [PacotesController::class, 'storeCartoes'])->name('pacotes.store-cartoes');
    Route::post('/novo-pacote', [PacotesController::class, 'store'])->name('pacotes.store');
    Route::post('/atualiza-pacote/{id}', [PacotesController::class, 'update'])->name('pacotes.update');
    Route::post('/busca-pacotes', [PacotesController::class, 'buscaPacote'])->name('pacotes.busca');
    Route::post('/vender-pacote/{id}', [PacotesController::class, 'venderPacote'])->name('pacotes.vender');



});
Route::prefix('servicos')->group(function () {

    Route::get('/', [ServicoController::class, 'index'])->name('servicos.index');
    Route::get('/novo-servico', [ServicoController::class, 'create'])->name('servicos.create');
    Route::post('/novo-servico', [ServicoController::class, 'store'])->name('servicos.store');
    Route::post('/atualiza-servico/{id}', [ServicoController::class, 'update'])->name('servicos.update');
    Route::post('/busca-servico', [ServicoController::class, 'buscaServico'])->name('servicos.busca');




});

Route::prefix('cartoes')->group(function () {

    Route::get('/', [CartaoController::class, 'index'])->name('cartoes.index');
    Route::post('/atualiza-cartao/{id}', [CartaoController::class, 'update'])->name('cartoes.update');
    Route::post('/busca-cartao', [CartaoController::class, 'buscaCartao'])->name('cartoes.busca');
    Route::post('/vender-cartao/{id}', [CartaoController::class, 'venderCartao'])->name('cartoes.vender');




});

Route::prefix('lojas')->group(function () {

    Route::get('/', [LojaController::class, 'index'])->name('lojas.index');
    Route::get('/nova-loja', [LojaController::class, 'create'])->name('lojas.create');
    Route::get('/edit-loja/{id}', [LojaController::class, 'edit'])->name('lojas.edit');
    Route::post('/nova-loja', [LojaController::class, 'store'])->name('lojas.store');
    Route::post('/atualiza-loja/{id}', [LojaController::class, 'update'])->name('lojas.update');
    Route::post('/busca-loja', [LojaController::class, 'buscaLoja'])->name('lojas.busca');

});

Route::prefix('usuarios')->group(function () {

    Route::get('/', [UserController::class, 'index'])->name('usuarios.index');
    Route::get('/novo-usuario', [UserController::class, 'create'])->name('usuarios.create');
    Route::get('/edit-usuario/{id}', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::post('/novo-usuario', [UserController::class, 'store'])->name('usuarios.store');
    Route::post('/atualiza-usuario/{id}', [UserController::class, 'update'])->name('usuarios.update');
    Route::post('/busca-usuario', [UserController::class, 'buscaUsuario'])->name('usuarios.busca');

});

Route::prefix('clientes')->group(function () {

    Route::get('/', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/novo-clientes', [ClienteController::class, 'create'])->name('clientes.create');
    Route::get('/edit-clientes/{id}', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::post('/novo-clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::post('/atualiza-clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::post('/busca-clientes', [ClienteController::class, 'buscaCliente'])->name('clientes.busca');

});

Route::prefix('pdv')->group(function () {

    Route::get('/', [PdvController::class, 'index'])->name('pdv.index');
    Route::get('/venda-cartao', [PdvController::class, 'vendaCartao'])->name('pdv.create');
    Route::post('/baixar-pontos/{id}', [PdvController::class, 'baixarPontos'])->name('pdv.baixar-pontos');
    Route::get('/historico/{id}', [PdvController::class, 'historico'])->name('pdv.historico');
    Route::post('/nova-venda', [PdvController::class, 'store'])->name('pdv.store');
    Route::post('/atualiza-venda/{id}', [PdvController::class, 'update'])->name('pdv.update');
    Route::get('/busca-venda', [PdvController::class, 'buscaCartaoVendido'])->name('pdv.busca');




});
