<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContestController;
use App\Http\Controllers\ContestProjectController;
use App\Http\Controllers\ProjectQuizController;
use App\Http\Controllers\ProjectTeamController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProjectResourceController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuizGradeController;

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

Route::get('/graphs', function () {
    return view('graphs');
})->middleware('auth')->name('graphs');

Route::resource('contests', ContestController::class);
Route::resource('contests.projects', ContestProjectController::class)->shallow();
Route::resource('projects.quizzes', ProjectQuizController::class)->shallow();
Route::resource('projects.teams', ProjectTeamController::class)->shallow();
Route::resource('projects.resources', ProjectResourceController::class)->only(['store']);

Route::post('/teams/{team}/join', [ProjectTeamController::class, 'join'])->name('teams.join');
Route::post('/teams/{team}/quit', [ProjectTeamController::class, 'quit'])->name('teams.quit');
Route::put('/teams/{team}/submit', [ProjectTeamController::class, 'submit'])->name('teams.submit');

Route::post('/projects/{project}/assign', [ContestProjectController::class, 'assignManager'])->name('projects.assign');
Route::get('/projects/{project}/podium', [ContestProjectController::class, 'podium'])->name('projects.podium');

Route::prefix('quizzes/{quiz}/teams/{team}')->group(function () {
    Route::get('answers', [AnswerController::class, 'show'])->name('answers.show');
    Route::post('answers', [AnswerController::class, 'store'])->name('answers.store');
    Route::post('grades', [QuizGradeController::class, 'store'])->name('grades.store');
});
Route::get('/quizzes/{quiz}/teams', [ProjectQuizController::class, 'showTeams'])->name('quizzes.teams');
Route::get('/quizzes/{quiz}/podium', [ProjectQuizController::class, 'showPodium'])->name('quizzes.podium');

Route::get('messages/sent', [MessageController::class, 'sent'])
     ->middleware(['auth'])->name('messages.sent');
Route::resource('messages', MessageController::class)
     ->except(['edit', 'update']);

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/manager.php';
