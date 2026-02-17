<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ExperienceController;

Route::prefix('v1')->group(function () {

    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/generate-cv', [CVController::class, 'download']);
    
    Route::get('/me', [PortfolioController::class, 'getPersonalInfos']);
    Route::get('/projects', [PortfolioController::class, 'getProjects']);
    Route::get('/courses', [PortfolioController::class, 'getCourses']);
    Route::get('/experiences', [PortfolioController::class, 'getExperiences']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::apiResource('projects', ProjectController::class)->except(['index', 'show']);
        Route::apiResource('experiences', ExperienceController::class)->except(['index', 'show']);
        
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });

});