<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProgramaController;
use App\Http\Controllers\Api\ProfileController;
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

    // Rotas de programas (admin)
    Route::get('/programas/{id}', [ProgramaController::class, 'show']);
    Route::post('/programas', [ProgramaController::class, 'store']);
    Route::put('/programas/{id}', [ProgramaController::class, 'update']);
    Route::delete('/programas/{id}', [ProgramaController::class, 'destroy']);

    // Rotas de perfil
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::patch('/profile', [ProfileController::class, 'update']);
    Route::put('/password', [ProfileController::class, 'updatePassword']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);
});

