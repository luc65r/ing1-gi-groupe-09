<?php

use Illuminate\Support\Facades\Route;

Route::middleware('is:admin')->group(function () {
    Route::get('/admin/users', function () {
        return view('admin.users');
    });
});
