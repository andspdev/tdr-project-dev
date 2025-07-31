<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BooksModel extends Model
{

    protected $table = 'books';
    protected $fillable = [
        'name',
        'author_id',
        'category_id',
        'created_at',
        'updated_at'
    ];
}
