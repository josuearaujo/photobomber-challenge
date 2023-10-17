<?php

use App\Http\Controllers\PhotoController;
use App\Http\Controllers\AlbumController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/photos', [PhotoController::class, 'index'])->name('photo.index');
    Route::get('/photos/{id}', [PhotoController::class, 'show'])->name('photo.show');

    Route::get('/photobooks', [AlbumController::class, 'index'])->name('photobook.index');
});

require __DIR__ . '/auth.php';
