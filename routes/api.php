<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\LoginApiController;
use App\Http\Controllers\SolicitacaoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginApiController::class, 'login']);

Route::group(['middleware' => 'auth-api'], function () {
    Route::post('atualizar-usuario', [ApiController::class, 'atualizarUsuario']);
    Route::post('carregar-dados', [ApiController::class, 'carregarDados']);
    Route::post('solicitacao', [ApiController::class, 'solicitacao'])->middleware(['throttle:2,1']);
    Route::get('tipos-atendimentos', [SolicitacaoController::class, 'getTiposAtendimentos']);
});
