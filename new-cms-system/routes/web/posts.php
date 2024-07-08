<?php

use Illuminate\Support\Facades\Route;


Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('post');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/post/create',[App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::get('/admin/post',[App\Http\Controllers\PostController::class, 'index'])->name('post.index');
    Route::post('/admin/post',[App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::delete('/admin/post/{id}',[App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');
    Route::get('/admin/post/{id}/edit',[App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
    Route::patch('/admin/post/{id}',[App\Http\Controllers\PostController::class, 'update'])->name('post.update');
    
});

