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

    //API-RELATIONSHIP
    public function director()
    {
        return $this->hasManyThrough(Director::class, MovieDirection::class, 'mov_id', 'dir_id', 'mov_id', 'dir_id');
    }
    public function genre()
    {
        return $this->hasManyThrough(Genres::class, MovieGenres::class, 'mov_id', 'gen_id', 'mov_id', 'gen_id');
    }

    public function actor()
    {
        return $this->hasManyThrough(Actor::class, MovieCast::class, 'mov_id', 'act_id', 'mov_id', 'act_id');
    }

    public function reviewer()
    {
        return $this->hasManyThrough(Reviewer::class, Rating::class, 'mov_id', 'rev_id', 'mov_id', 'rev_id');
    }
}
