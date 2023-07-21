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
            'mov_id' => 'required|integer',
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
    
        // Create the Movie model
        $movie = Movie::create([
            'mov_id' => $request->input('mov_id'),
            'mov_title' => $request->input('mov_title'),
            'mov_year' => $request->input('mov_year'),
            'mov_time' => $request->input('mov_time'),
            'mov_lang' => $request->input('mov_lang'),
            'mov_dt_rel' => $request->input('mov_dt_rel'),
            'mov_rel_country' => $request->input('mov_rel_country'),
        ]);
    
        // Associate actors, directors, genres
        $actors = Actor::find($request->input('act_id'));
        $directors = Director::find($request->input('dir_id'));
        $genres = Genres::find($request->input('gen_id'));
    
        $movie->actors()->attach($actors, ['role' => $request->input('role')]);
        $movie->directors()->attach($directors);
        $movie->genres()->attach($genres);
    
        // Assuming you have a `Reviewer` model and `ratings` relationship defined in the `Movie` model
        $reviewer = Reviewer::find($request->input('rev_id'));
        $rating = new Rating(['rating' => $request->input('rating')]);
        $reviewer->ratings()->save($rating);
    
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
        $movie->delete();
        return redirect()->route('movies.index')->with('success','Movie has been deleted successfully');
    }
}
