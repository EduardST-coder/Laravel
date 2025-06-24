<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\Blog\Admin\CategoryController;
use App\Http\Controllers\Blog\Admin\PostController as AdminPostController;
use App\Http\Controllers\DiggingDeeperController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// CRUD для публічних постів
Route::prefix('blog')->group(function () {
    Route::resource('posts', PostController::class)->names('blog.posts');
});

// Адмінка категорій і постів
Route::prefix('admin/blog')->group(function () {
    Route::resource('categories', CategoryController::class)
        ->only(['index', 'edit', 'update', 'create', 'store'])
        ->names('blog.admin.categories');

    Route::resource('posts', AdminPostController::class)
        ->except(['show'])
        ->names('blog.admin.posts');
});

// Лабораторна 11 — колекції
Route::prefix('digging_deeper')->group(function () {
    Route::get('collections', [DiggingDeeperController::class, 'collections'])
        ->name('digging_deeper.collections');
});
