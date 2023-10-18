<?php

use App\Http\Controllers\AlbumCompilationWebhookController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UploadPhotoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/photos', UploadPhotoController::class);
    Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photo.destroy');

    Route::post('/albums/{album}/photos/{photo}', [AlbumController::class, 'addPhoto'])->name('album.add-photo');
    Route::delete('/albums/{album}/photos/{photo}', [AlbumController::class, 'removePhoto'])->name('album.remove-photo');
    Route::post('/albums/compile/{album}', [AlbumController::class, 'compile'])->name('album.compile');
});

Route::post('/webhooks/compilation', AlbumCompilationWebhookController::class);
