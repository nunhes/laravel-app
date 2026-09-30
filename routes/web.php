<?php

// use App\Http\Controllers\DatabaseTestController;  -> só para probas
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('home');
})->name('home');


/* ruta só para test de funcionamento */
// Route::get('/database-test', [DatabaseTestController::class, 'index']);

// Route::resource('projects', ProjectController::class);
Route::resource('projects', ProjectController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy'])
    ->middleware('auth');

Route::resource('projects', ProjectController::class)
    ->only(['index', 'show']);

//Route::resource('projects.tasks', TaskController::class)
  //  ->except(['show'])
   // ->scoped();

Route::resource('projects.tasks', TaskController::class)
    ->only(['index'])
    ->scoped();

Route::resource('projects.tasks', TaskController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy'])
    ->middleware('auth')
    ->scoped();


// zona privada
Route::get('/login', [AuthController::class, 'create'])
    ->name('login');

Route::post('/login', [AuthController::class, 'store'])
    ->name('login.store');

Route::post('/logout', [AuthController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
