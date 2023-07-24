<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use \Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Director;
use App\Models\Actor;
use App\Models\Genres;
use App\Models\Reviewer;
use App\Models\Rating;
use App\Models\MovieCast;
use App\Models\MovieDirection;
use App\Models\MovieGenres;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::paginate(10);
        return view('movies.index', compact('movies'));
    }

    public function showMovieDetail($id)
    {
        $movie = Movie::with('directors', 'actors', 'genres', 'ratings.reviewer')->findOrFail($id);

        $data = [
            'movie' => $movie,
            'directors' => $movie->directors ?? 'Null',
            'actors' => $movie->actors->first() ?? 'Null',
            'genres' => $movie->genres->first() ?? 'Null',
            'reviewer' => $movie->ratings->first()->reviewer ?? 'Null',
            'rating' => $movie->ratings->first() ?? 'Null',
        ];

        return view('movies.details')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $directors = Director::all();
        $actors = Actor::all();
        $genres = Genres::all();
        $reviewers = Reviewer::all();

        return view('movies.create', compact('directors', 'actors', 'genres', 'reviewers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'mov_id' => 'required|integer',
            'mov_title' => 'required|string|max:255',
            'mov_year' => 'required|integer',
            'mov_time' => 'required|string|max:255',
            'mov_lang' => 'required|string|max:255',
            'mov_dt_rel' => 'required|date',
            'mov_rel_country' => 'required|string|max:255',
            'dir_id' => 'required|exists:director,dir_id',
            'act_id' => 'required|exists:actor,act_id',
            'gen_id' => 'required|exists:genres,gen_id',
            'rev_id' => 'required|exists:reviewer,rev_id',
            'role' => 'required|string|max:30', // Assuming the maximum length of 'role' is 30 characters
        ]);

        // Get the latest movie's mov_id
        $latestMovie = Movie::latest('mov_id')->first();

        // Increment the mov_id for the new movie
        $newMovId = $latestMovie ? $latestMovie->mov_id + 1 : 1;

        // Generate a random number between 100 and 500
        $randomNumRatings = rand(100, 5000);

        // Create the Movie model
        $movie = Movie::create([
            'mov_id' => $newMovId,
            'mov_title' => $request->input('mov_title'),
            'mov_year' => $request->input('mov_year'),
            'mov_time' => $request->input('mov_time'),
            'mov_lang' => $request->input('mov_lang'),
            'mov_dt_rel' => $request->input('mov_dt_rel'),
            'mov_rel_country' => $request->input('mov_rel_country'),
        ]);
        
        
        $movcast = new MovieCast;
        $movcast->act_id = $request->input('act_id');
        $movcast->mov_id = $newMovId;
        $movcast->role = $request->input('role');

        $movDirection = new MovieDirection;
        $movDirection->dir_id = $request->input('dir_id');
        $movDirection->mov_id = $newMovId;

        $movgen = new MovieGenres;
        $movgen->mov_id = $newMovId;
        $movgen->gen_id = $request->input('gen_id');

        $rating = new Rating;
        $rating->mov_id = $newMovId;
        $rating->rev_id = $request->input('rev_id');
        $rating->rev_stars = $request->input('rating');
        $rating->num_o_ratings = $randomNumRatings;

        $movcast->save();
        $movDirection->save();
        $movgen->save();
        $rating->save();
    
        return redirect()->route('movies.index')->with('success', 'Movie created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        // Assuming $movie is an instance of the Movie class with the desired mov_id
        $movie = Movie::find($movie->mov_id);

        // Call the deleteMovie() method to delete the movie and related records
        $movie->deleteMovie();
        return redirect()->route('movies.index')->with('success','Movie has been deleted successfully');
    }
}
