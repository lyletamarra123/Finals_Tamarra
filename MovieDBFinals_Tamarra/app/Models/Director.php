<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'director';
    protected $primaryKey = 'dir_id';
    
    protected $fillable = [
        'dir_id',
        'dir_fname',
        'dir_lname',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_direction', 'dir_id', 'mov_id');
    }
}
