<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
 
    Route::get('/admin/user/{id}/profile',[App\Http\Controllers\UserController::class,'show'])->name('user.profile.show');
    Route::put('/admin/user/{id}/update',[App\Http\Controllers\UserController::class,'update'])->name('user.profile.update');
    
    Route::delete('/admin/user/{id}',[App\Http\Controllers\UserController::class,'destroy'])->name('user.destroy');
});

Route::middleware(["auth","role:Admin"])->group(function () {
    Route::get('/admin/users',[App\Http\Controllers\UserController::class,'index'])->name('user.index');

    Route::put('/users/{id}/attach',[App\Http\Controllers\UserController::class,'attach'])->name('user.role.attach');
    Route::put('/users/{id}/detach',[App\Http\Controllers\UserController::class,'detach'])->name('user.role.detach');
});