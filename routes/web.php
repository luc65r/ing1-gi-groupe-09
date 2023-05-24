<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContestController;
use App\Http\Controllers\ContestProjectController;
use App\Http\Controllers\ProjectQuizController;

/*
   |--------------------------------------------------------------------------
   | Web Routes
   |--------------------------------------------------------------------------
   |
   | Here is where you can register web routes for your application. These
   | routes are loaded by the RouteServiceProvider within a group which
   | contains the "web" middleware group. Now create something great!
   |
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::resource('contests', ContestController::class);
Route::resource('contests.projects', ContestProjectController::class)->shallow();
Route::resource('projects.quizzes', ProjectQuizController::class)->shallow();

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/manager.php';
