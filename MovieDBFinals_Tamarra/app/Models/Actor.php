<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'actor';
    protected $primaryKey = 'act_id';
    
    protected $fillable = [
        'act_id',
        'act_fname',
        'act_lname',
        'act_age',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_cast', 'act_id', 'mov_id')->withPivot('role');
    }
}
