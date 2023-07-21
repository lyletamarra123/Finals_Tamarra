<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieGenres extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'movie_genres';

    protected $fillable = [
        'mov_id',
        'gen_id',
    ];
}
