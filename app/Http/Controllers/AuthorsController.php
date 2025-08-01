<?php

namespace App\Http\Controllers;

use App\Models\AuthorsModel;
use Illuminate\Support\Facades\DB;

class AuthorsController extends Controller
{
    public function index()
    {
        $data['title'] = 'Top 10 Most Famous Author';

        $startTime = microtime(true);

        $authors = AuthorsModel::select([
            'authors.id',
            'authors.name',
            DB::raw('COUNT(r.id) as total_voter')
        ])->join('books', 'books.author_id', '=', 'authors.id')
            ->join(DB::raw('(SELECT * FROM ratings WHERE rating > 5) as r'), 'r.book_id', '=', 'books.id')
            ->groupBy('authors.id', 'authors.name')
            ->orderByDesc('total_voter')
            ->limit(10)
            ->get();

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;

        $data['executionTime'] = $executionTime;
        $data['authors'] = $authors;

        return view('top-authors', $data);
    }
}
