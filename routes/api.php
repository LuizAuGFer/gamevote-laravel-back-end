<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Account
Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [UserController::class, 'me'])->name('me');

    // Admin
    Route::middleware('administrative-access')->group(function () {

        Route::prefix('games')->group(function () {
            Route::post('/store', [GameController::class, 'store'])->name('games.store');
            Route::get('/query', [GameController::class, 'query'])->name('games.query');
            Route::post('/update/{game_id}', [GameController::class, 'update'])->name('games.update');
            Route::delete('{game_id}/destroy', [GameController::class, 'destroy'])->name('games.destroy');
        });

        Route::prefix('categories')->group(function () {
            Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
            Route::get('/all', [CategoryController::class, 'all'])->name('categories.all');
            Route::delete('/{category_id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        });

    });
});
