<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatingsModel extends Model
{

    protected $table = 'ratings';
    protected $fillable = [
        'book_id',
        'rating'
    ];
}
