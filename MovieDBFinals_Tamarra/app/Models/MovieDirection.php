<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieDirection extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'movie_direction';
    protected $primaryKey = 'dir_id';
    public $timestamps = false;
    
    protected $fillable = [
        'dir_id',
        'mov_id',
    ];
}
