<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ConfiguracaoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EncaminhamentoController;
use App\Http\Controllers\MoradorRuaController;
use App\Http\Controllers\ParametroController;
use App\Http\Controllers\ParceiroController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['login']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::group(['middleware' => ['auth', 'roles']], function () {

    // COMUM
    Route::group(['modulo' => 'comum'], function () {
        Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/dashboard/parceiro', [DashboardController::class, 'parceiro'])->name('dashboard.parceiro.index');
        Route::get('/dashboard/operador', [DashboardController::class, 'operador'])->name('dashboard.operador.index');
    });

    //MORADORES DE RUA
    Route::group(['modulo' => 'morador-de-rua'], function () {
        Route::resource('/moradores-de-rua', MoradorRuaController::class)->parameter('moradores-de-rua', 'morador')
            ->except(['destroy'])->names('morador-rua');
        Route::get('/moradores-de-rua-delete/{morador}', [MoradorRuaController::class, 'delete'])
            ->name('morador-rua.delete');
        Route::put('/moradores-de-rua-alterar-foto/{morador}', [MoradorRuaController::class, 'alterarFoto'])
            ->name('morador-rua.alterar-foto');
        Route::put('/moradores-de-rua-identificacao/{identificacao}', [MoradorRuaController::class, 'identificacao'])
            ->name('morador-rua.identificacao');
        Route::put('/moradores-de-rua-outras-informacoes/{informacao}',
            [MoradorRuaController::class, 'outrasInformacoes']
        )->name('morador-rua.outras-informacoes');
        Route::post('/moradores-de-rua-encaminhar', [EncaminhamentoController::class, 'encaminhar'])
            ->name('morador-rua.encaminhar');
    });

    //PARCEIROS
    Route::group(['modulo' => 'parceiros'], function () {
        Route::resource('/parceiros', ParceiroController::class)->parameter('parceiros', 'parceiro')
            ->except(['destroy'])->names('parceiros');
        Route::get('/parceiros-status/{parceiro}', [ParceiroController::class, 'status'])
            ->name('parceiros.status');
        Route::post('/parceiros-disponivel/{parceiro}', [ParceiroController::class, 'disponivel'])
            ->name('parceiros.disponivel');
        Route::get('/parceiros/usuarios/{parceiro}', [ParceiroController::class, 'usuarios'])
            ->name('parceiros.usuarios.datatables');
        Route::get('/parceiros/get-usuarios/{parceiro}', [ParceiroController::class, 'usuariosNaoRelacionados'])
            ->name('parceiros.get-usuarios');
        Route::post('/parceiros/usuarios', [ParceiroController::class, 'relacionarUsuarios'])
            ->name('parceiros.add-usuarios');
        Route::post('/parceiros/remover-usuario', [ParceiroController::class, 'removerUsuario'])
            ->name('parceiros.remover-usuario');
    });

    //USUARIOS
    Route::group(['modulo' => 'usuarios'], function () {
        Route::resource('/usuarios', UsuarioController::class)->parameter('usuarios', 'usuario')
            ->except(['destroy'])->names('usuarios');
        Route::get('/usuarios-status/{usuario}', [UsuarioController::class, 'status'])
            ->name('usuarios.status');
    });

    // CONFIGURAÇÕES
    Route::group(['modulo' => 'configuracoes'], function () {
        //CONFIGURACOES - Parceiros
        Route::get('configuracoes/parceiros', [ConfiguracaoController::class, 'parceiros'])
            ->name('configuracoes.parceiros.index');

        //CONFIGURACOES - Usuários
        Route::get('configuracoes/usuarios', [ConfiguracaoController::class, 'usuarios'])
            ->name('configuracoes.usuarios.index');

        //CONFIGURACOES - Parâmetros
        Route::get('configuracoes/parametros', [ParametroController::class, 'index'])
            ->name('configuracoes.parametros.index');
        Route::post('configuracoes/parametros/update', [ParametroController::class, 'update'])
            ->name('configuracoes.parametros.update');
        Route::post('configuracoes/parametros/delete', [ParametroController::class, 'delete'])
            ->name('configuracoes.parametros.delete');
        Route::post('configuracoes/parametros/store', [ParametroController::class, 'store'])
            ->name('configuracoes.parametros.store');
    });

    //USUARIOS
    Route::group(['modulo' => 'acessos'], function () {
        Route::get('perfis', [PerfilController::class, 'index'])
            ->name('perfil.index');
        Route::post('/atualizar-rotas', [PerfilController::class, 'atualizarRotas'])
            ->name('perfil.atualizar-rotas');
    });

});
