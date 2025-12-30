<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AdvertisementController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\SettingController;
use Illuminate\Support\Facades\Route;

// Auth Routes (Public)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ============================================
// Recovery App API Routes
// ============================================

use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\RelapseController;
use App\Http\Controllers\Api\ContentController;
use App\Http\Controllers\Api\MoodController;
use App\Http\Controllers\Api\StatsController;

// Public Recovery App Routes
Route::post('/guest-login', [AuthController::class, 'guestLogin']);

// Protected Recovery App Routes (Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/profile', [AuthController::class, 'updateProfile']);
    Route::get('/home', [HomeController::class, 'index']);
    Route::post('/relapse', [RelapseController::class, 'store']);
    Route::get('/content', [ContentController::class, 'index']);
    Route::get('/content/{id}', [ContentController::class, 'show']);
    Route::post('/mood', [MoodController::class, 'store']);
    Route::get('/stats', [StatsController::class, 'index']);
});


