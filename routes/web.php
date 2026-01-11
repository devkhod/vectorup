<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/admin/upload', [UploadController::class, 'store'])
    ->middleware(['auth', 'admin'])
    ->name('admin.upload');


Route::get('/categories/{slug}', [CategoryController::class, 'show'])
    ->name('categories.show');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');



//----------------------------------------  ADMIN  --------------------------------------------------//

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', function () {
            return redirect()->route('admin.articles.index');
        })->name('dashboard');

        Route::resource('articles', AdminArticleController::class);
        Route::resource('categories', AdminCategoryController::class);
    });
//----------------------------------------  ADMIN  --------------------------------------------------//