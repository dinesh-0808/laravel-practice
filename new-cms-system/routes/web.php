<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('post');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminsController::class, 'index'])->name('admin.index');
    Route::get('/admin/post/create',[App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::get('/admin/post',[App\Http\Controllers\PostController::class, 'index'])->name('post.index');
    Route::post('/admin/post',[App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::delete('/admin/post/{id}',[App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');
    Route::get('/admin/post/{id}/edit',[App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
    Route::patch('/admin/post/{id}',[App\Http\Controllers\PostController::class, 'update'])->name('post.update');
    
    Route::get('/admin/user/{id}/profile',[App\Http\Controllers\UserController::class,'show'])->name('user.profile.show');
    Route::put('/admin/user/{id}/update',[App\Http\Controllers\UserController::class,'update'])->name('user.profile.update');
    Route::get('/admin/users',[App\Http\Controllers\UserController::class,'index'])->name('user.index');
    Route::delete('/admin/user/{id}',[App\Http\Controllers\UserController::class,'destroy'])->name('user.destroy');
});