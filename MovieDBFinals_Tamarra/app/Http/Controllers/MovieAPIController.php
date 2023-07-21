<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;
use App\Models\Genres;
use App\Models\Actor;
use App\Models\Director;

class MovieAPIController extends Controller
{
    public function getMovies()
    {
        $movies = Movie::all();
        return response()->json($movies);
    }

    public function getGenres()
    {
        $genres = Genres::all();
        return response()->json($genres);
    }

    public function getActors()
    {
        $actors = Actor::all();
        return response()->json($actors);
    }

    public function getDirectors()
    {
        $directors = Director::all();
        return response()->json($directors);
    }

    public function getMovieDetails($mov_id)
    {
        $movie = Movie::find($mov_id);  
        if ($movie) {
            $director = $movie->director;
            $genre = $movie->genre;
            $actors = $movie->actor;
            $reviewers = $movie->reviewer;
    
            return response()->json(['movie' => $movie]);
        } else {
            return response()->json(['error' => 'Movie not found'], 404);
        }
    }
}
