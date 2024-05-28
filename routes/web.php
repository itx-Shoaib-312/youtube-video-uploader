<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YouTubeController;

Route::get('/', function () {
    return view('welcome');
});
Route::post('upload', [YouTubeController::class, 'uploadVideo'])->name('upload');
Route::get('/upload', [YouTubeController::class, 'showUploadForm'])->name('upload');
Route::get('/auth/google', [YouTubeController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/callback', [YouTubeController::class, 'handleGoogleCallback']);
