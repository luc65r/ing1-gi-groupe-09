<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::group(['middleware' => 'is:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('/users', UserController::class)->except(['store', 'edit', 'update']);
    Route::get('/users/create/student', [UserController::class, 'createStudent'])->name('users.createStudent');
    Route::get('/users/create/manager', [UserController::class, 'createManager'])->name('users.createManager');
    Route::get('/users/create/admin', [UserController::class, 'createAdmin'])->name('users.createAdmin');
    Route::post('/users/student', [UserController::class, 'storeStudent'])->name('users.storeStudent');
    Route::post('/users/manager', [UserController::class, 'storeManager'])->name('users.storeManager');
    Route::post('/users/admin', [UserController::class, 'storeAdmin'])->name('users.storeAdmin');


});

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('/users', UserController::class)->only(['edit', 'update']);
});