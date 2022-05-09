<?php

use App\Http\Controllers\ChoreController;
use App\Http\Controllers\ChoreTaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/login', [LoginController::class, 'select'])
    ->name('profiles.select');

Route::get('/login/{profile}', [LoginController::class, 'login'])
    ->name('profiles.login');

Route::get('/dashboard', DashboardController::class)
    ->middleware('profile')
    ->name('dashboard');

Route::post('/open/{chore}', [ChoreTaskController::class, 'open'])
    ->name('task.open');
Route::post('/claim/{choreTask}', [ChoreTaskController::class, 'claim'])
    ->middleware('profile')
    ->name('task.claim');
Route::post('/complete/{choreTask}', [ChoreTaskController::class, 'complete'])
    ->middleware('profile')
    ->name('task.complete');

/**
 * ADMIN ROUTES
 */

Route::resource('profiles', ProfileController::class)
    ->only('index', 'create', 'store', 'destroy');

Route::resource('chores', ChoreController::class)
    ->only('index', 'create', 'store');

Route::get('history', HistoryController::class);
