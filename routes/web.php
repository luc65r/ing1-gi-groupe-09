<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContestController;
use App\Http\Controllers\ContestProjectController;
use App\Http\Controllers\ProjectQuizController;
use App\Http\Controllers\ProjectTeamController;
use App\Http\Controllers\MessageController;

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

Route::get('/dataMoment', function () {
    return view('dataMoment');
})->name('dataMoment');

Route::get('/dataAncien', function () {
    return view('dataAncien');
})->name('dataAncien');

Route::get('/graphs', function () {
    return view('graphs');
})->name('graphs');


Route::resource('contests', ContestController::class);
Route::resource('contests.projects', ContestProjectController::class)->shallow();
Route::resource('projects.quizzes', ProjectQuizController::class)->shallow();
Route::resource('projects.teams', ProjectTeamController::class)->shallow();

Route::post('/teams/{team}/join', [ProjectTeamController::class, 'join'])->name('teams.join');

Route::get('/quizzes/{quiz}/responses', [ProjectQuizController::class, 'responses'])->name('quizzes.responses');



Route::get('messages/sent', [MessageController::class, 'sent'])
    ->middleware(['auth'])->name('messages.sent');
Route::resource('messages', MessageController::class)
    ->except(['edit', 'update']);

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/manager.php';
