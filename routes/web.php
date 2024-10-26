<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\userController;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('login.view');

Route::get('register', function () {
    return view('register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard-user', ['title' => 'Dashboard'], ['articles' => Article::with('author')->get()]);
    })->middleware('auth')->name('dashboard-user');


    Route::get('/form-article', [ArticleController::class, 'form'])->name('mulai-menulis');

    Route::get('/myArticle', [ArticleController::class, 'myArticleView'])->name('myArticle');
});


Route::post('logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


Route::post('register', [userController::class, 'store'])->name('register.create');
Route::post('article', [ArticleController::class, 'create'])->name('article.create');
Route::post('login', [userController::class, 'authentication'])->name('login.auth');

Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');
Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('article.update');
Route::get('/articles/{id}', [ArticleController::class, 'detail'])->name('article.detail');
