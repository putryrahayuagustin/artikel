<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\ApiKeyMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/article/create', [ArticleController::class, 'store']);
    Route::put('/article/update/{id}', [ArticleController::class, 'update']);
    Route::delete('/article/delete/{id}', [ArticleController::class, 'destroy']);
});


Route::post('login', [AuthController::class, 'login']);

Route::middleware([ApiKeyMiddleware::class,])->group(function () {
    Route::get('/articles', [ArticleController::class, 'showALL']);
    Route::get('/articles/{id}', [ArticleController::class, 'detailById']);
});
