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

// Route::middleware('auth:sanctum')->group(function () {
//     // Route untuk mengambil semua artikel dengan kategori "Keperawatan"
//     Route::get('/articles/keperawatan', [ArticleController::class, 'showALL']);
// });
Route::post('loginapi', [AuthController::class, 'login']);

Route::middleware([ApiKeyMiddleware::class, 'auth:sanctum'])->group(function () {
    Route::get('/articles/keperawatan', [ArticleController::class, 'showALL']);
});
