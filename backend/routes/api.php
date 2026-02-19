<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\CurriculoController;
use App\Http\Controllers\Api\AutenticacaoController;
use App\Http\Controllers\Api\ProjetoController;
use App\Http\Controllers\Api\ExperienciaController;
use App\Http\Controllers\Api\CursoController;

Route::prefix('v1')->group(function () {

    // Autenticação e Download Público
    Route::post('/login', [AutenticacaoController::class, 'login']);
    Route::get('/generate-cv', [CurriculoController::class, 'download']);
    
    // Rotas Públicas de Consumo Angular Home
    Route::get('/me', [PortfolioController::class, 'getInformacoesPessoais']);
    Route::get('/projects', [PortfolioController::class, 'getProjetos']);
    Route::get('/courses', [PortfolioController::class, 'getCursos']);
    Route::put('/me', [PortfolioController::class, 'updateInformacoesPessoais']);
    Route::get('/experiences', [ExperienciaController::class, 'index']);

    // Rotas Protegidas
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AutenticacaoController::class, 'logout']);
        
        // CRUD de Projetos e Experiências para o Painel Admin
        Route::apiResource('projects', ProjetoController::class)->except(['index', 'show']);
        Route::apiResource('experiences', ExperienciaController::class)->except(['index', 'show']);
        Route::apiResource('courses', CursoController::class)->except(['index', 'show']);
        
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });

});