<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\Blog\Admin\CategoryController;

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

// CRUD для BlogPost
Route::prefix('blog')->group(function () {
    Route::resource('posts', PostController::class)->names('blog.posts');
});

// Адмінка категорій
Route::prefix('admin/blog')->group(function () {
    Route::resource('categories', CategoryController::class)
        ->only(['index', 'edit', 'update', 'create', 'store'])
        ->names('blog.admin.categories');
});
