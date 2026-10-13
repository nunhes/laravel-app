<?php

// use App\Http\Controllers\DatabaseTestController;  -> só para probas
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// para recuperar contrasinal
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

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

// Recuperación de contrasinal
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [
        PasswordResetLinkController::class,
        'create',
    ])->name('password.request');

    Route::post('/forgot-password', [
        PasswordResetLinkController::class,
        'store',
    ])->name('password.email');

    Route::get('/reset-password/{token}', [
        NewPasswordController::class,
        'create',
    ])->name('password.reset');

    Route::post('/reset-password', [
        NewPasswordController::class,
        'store',
    ])->name('password.update');
});



// zona privada
Route::get('/login', [AuthController::class, 'create'])
    ->name('login');

Route::post('/login', [AuthController::class, 'store'])
    ->name('login.store');

Route::post('/logout', [AuthController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
