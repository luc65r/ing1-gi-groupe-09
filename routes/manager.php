<?php

use Illuminate\Support\Facades\Route;

Route::middleware('is:manager')->group(function () {
    Route::get('/manager/projects', function () {
        return view('manager.projects');
    });
});
