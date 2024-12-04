<?php

use App\Http\Controllers\Api\ProfissaoController;
use Illuminate\Support\Facades\Route;

Route::get('/profissoes', [ProfissaoController::class, 'index']);
Route::get('/profissoes/{profissao}', [ProfissaoController::class, 'show']);
Route::post('/profissoes',[ProfissaoController::class, 'store']);

