<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $table = 'movie';
    protected $primaryKey = 'mov_id';
    public $timestamps = false;

    protected $fillable = [
        'mov_id',
        'mov_title',
        'mov_year',
        'mov_time',
        'mov_lang',
        'mov_dt_rel',
        'mov_rel_country',
    ];

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'movie_cast', 'mov_id', 'act_id')
            ->withPivot('role');
    }
    
    public function directors()
    {
        return $this->belongsToMany(Director::class, 'movie_direction', 'mov_id', 'dir_id');
    }
    
    public function genres()
    {
        return $this->belongsToMany(Genres::class, 'movie_genres', 'mov_id', 'gen_id');
    }
    
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'mov_id');
    }

    public function deleteMovie()
    {
        $this->deleteMovieCast();
        $this->deleteMovieDirection();
        $this->deleteMovieGenres();
        $this->deleteRatings();
        $this->deleteMovieRecord();
    }

    // Private helper methods for deleting related records
    private function deleteMovieCast()
    {
        // Delete related records from the movie_cast table
        $this->actors()->detach();
    }

    private function deleteMovieDirection()
    {
        // Delete related records from the movie_direction table
        $this->directors()->detach();
    }

    private function deleteMovieGenres()
    {
        // Delete related records from the movie_genres table
        $this->genres()->detach();
    }

    private function deleteRatings()
    {
        // Delete related records from the ratings table
        $this->ratings()->delete();
    }

    private function deleteMovieRecord()
    {
        // Delete the movie record itself
        $this->delete();
    }
}
