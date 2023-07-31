<?php

use App\Http\Controllers\AuthMovieController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieAPIController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [MovieController::class, 'index'])->name('index');
// Route::any('/details/{id}', [MovieController::class, 'showMovieDetail'])->name('details');
// Route::get('/', [MovieController::class, 'index'])->name('movies.index');
// Route::get('/add-movie', [MovieController::class, 'create'])->name('movies.create');

Route::middleware('auth', 'xss')->group(function () {
    Route::resource('/movies', MovieController::class);
    Route::get('/movies/{id}/details', [MovieController::class, 'showMovieDetail'])->name('movies.details');
    Route::get('logout', [AuthMovieController::class, 'logout'])->name('logout');

    // Route::get('/api/moviesAPI', [MovieAPIController::class, 'getMovies']);
    // Route::get('/api/actorsAPI', [MovieAPIController::class, 'getActors']);
    // Route::get('/api/genresAPI', [MovieAPIController::class, 'getGenres']);
    // Route::get('/api/directorsAPI', [MovieAPIController::class, 'getDirectors']);
    // Route::get('/api/moviesAPI/{mov_id}', [MovieAPIController::class, 'getMovieDetails']);
});

Route::get('login', [AuthMovieController::class, 'showLoginForm'])->name('login');
Route::post('post-login', [AuthMovieController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthMovieController::class, 'showRegisterForm'])->name('register');
Route::post('post-registration', [AuthMovieController::class, 'postRegistration'])->name('register.post');
