<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ProgramaController;
use Illuminate\Support\Facades\Route;

// Rotas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rota pública para listar programas
Route::get('/programas', [ProgramaController::class, 'index']);

// Rotas protegidas por autenticação
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Rotas de programas (criar, editar e excluir exigem admin — checado nos Requests)
    Route::get('/programas/{id}', [ProgramaController::class, 'show'])->whereNumber('id');
    Route::post('/programas', [ProgramaController::class, 'store']);
    Route::put('/programas/{id}', [ProgramaController::class, 'update'])->whereNumber('id');
    Route::delete('/programas/{id}', [ProgramaController::class, 'destroy'])->whereNumber('id');

    // Rotas de perfil
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::patch('/profile', [ProfileController::class, 'update']);
    Route::put('/password', [ProfileController::class, 'updatePassword']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);
});
