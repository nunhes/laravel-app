<?php

// use App\Http\Controllers\DatabaseTestController;  -> só para probas
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/* ruta só para test de funcionamento */
// Route::get('/database-test', [DatabaseTestController::class, 'index']);

Route::resource('projects', ProjectController::class);
