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
            // Get director(s)
            $directors = $movie->directors()->get();

            // Get genre(s)
            $genres = $movie->genres()->get();

            // Get actor(s) with their respective roles in the movie
            $actors = $movie->actors()->withPivot('role')->get();

            // Get reviewer(s) or ratings (assuming there's a Rating model)
            $reviewers = $movie->ratings()->get();

            return response()->json([
                'movie' => $movie,
                'directors' => $directors,
                'genres' => $genres,
                'actors' => $actors,
                'reviewers' => $reviewers,
            ]);
        } else {
            return response()->json(['error' => 'Movie not found'], 404);
        }
    }

}
