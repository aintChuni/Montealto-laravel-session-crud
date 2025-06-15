<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostSessionController;

Route::get('/', fn() => redirect('/posts'));

Route::get('/posts', [PostSessionController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostSessionController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostSessionController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}/edit', [PostSessionController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostSessionController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostSessionController::class, 'destroy'])->name('posts.destroy');
