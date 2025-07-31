<?php

namespace App\Http\Controllers;

use App\Models\AuthorsModel;

class AuthorsController extends Controller
{
    public function index()
    {
        $data['title'] = 'Top 10 Most Famous Author';

        $authors = AuthorsModel::selectRaw('
            SQL_NO_CACHE
            authors.name,
            COUNT(ratings.id) as total_voter
        ')->leftJoin('books', 'books.author_id', '=', 'authors.id')
            ->leftJoin('ratings', 'ratings.book_id', '=', 'books.id')
            ->groupBy('authors.id')
            ->orderBy('total_voter', 'DESC')
            ->limit(10)
            ->get();

        $data['authors'] = $authors;

        return view('top-authors', $data);
    }
}
