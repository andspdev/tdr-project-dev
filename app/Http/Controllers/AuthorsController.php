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
            DB::raw('COUNT(ratings.id) as total_voter')
        ])->join('books', 'books.author_id', '=', 'authors.id')
            ->join('ratings', function ($join) {
                $join->on('ratings.book_id', '=', 'books.id')
                    ->where('ratings.rating', '>', 5);
            })
            ->groupBy([
                'authors.id',
                'authors.name'
            ])
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
