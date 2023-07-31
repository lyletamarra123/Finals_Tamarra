<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieAPIController;
use App\Http\Controllers\AuthMovieController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('login', [AuthMovieController::class, 'showLoginForm'])->name('login');
// Route::post('post-login', [AuthMovieController::class, 'postLogin'])->name('login.post'); 
// Route::get('registration', [AuthMovieController::class, 'showRegisterForm'])->name('register');
// Route::post('post-registration', [AuthMovieController::class, 'postRegistration'])->name('register.post');

Route::middleware('auth:sanctum', 'web')->group(function () {
    Route::get('/moviesAPI', [MovieAPIController::class, 'getMovies']);
    Route::get('/actorsAPI', [MovieAPIController::class, 'getActors']);
    Route::get('/genresAPI', [MovieAPIController::class, 'getGenres']);
    Route::get('/directorsAPI', [MovieAPIController::class, 'getDirectors']);
    Route::get('/moviesAPI/{mov_id}', [MovieAPIController::class, 'getMovieDetails']);
});
