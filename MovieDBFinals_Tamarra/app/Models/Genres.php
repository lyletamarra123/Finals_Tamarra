<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genres extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'genres';
    protected $primaryKey = 'gen_id';
    
    protected $fillable = [
        'gen_id',
        'gen_title',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_genres', 'gen_id', 'mov_id');
    }
}
