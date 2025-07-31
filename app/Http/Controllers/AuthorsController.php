<?php

namespace App\Http\Controllers;

use App\Models\AuthorsModel;

class AuthorsController extends Controller
{
    public function index()
    {
        $data['title'] = 'Top 10 Most Famous Author';

        $startTime = microtime(true);

        $authors = AuthorsModel::selectRaw('
            SQL_NO_CACHE
            authors.name,
            COUNT(ratings.id) as total_voter
        ')->join('books', 'books.author_id', '=', 'authors.id')
            ->join('ratings', function ($join) {
                $join->on('ratings.book_id', '=', 'books.id')
                    ->where('ratings.rating', '>', 5);
            })
            ->groupBy('authors.id')
            ->orderBy('total_voter', 'DESC')
            ->limit(10)
            ->get();

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;

        $data['executionTime'] = $executionTime;
        $data['authors'] = $authors;

        return view('top-authors', $data);
    }
}
