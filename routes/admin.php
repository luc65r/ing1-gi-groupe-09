<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::group(['middleware' => 'is:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    // ...
    Route::resource('/users', UserController::class);
});


?>
