<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'rating';

    protected $fillable = [
        'mov_id',
        'rev_id',
        'rev_stars',
        'num_o_ratings',
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'mov_id');
    }
    
    public function reviewer()
    {
        return $this->belongsTo(Reviewer::class, 'rev_id');
    }
}
