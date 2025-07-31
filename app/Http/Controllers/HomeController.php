<?php

namespace App\Http\Controllers;

use App\Models\BooksModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('q') ?? '';
        $search = trim($search);
        $limit = $request->get('limit');
        $limit = is_numeric($limit) && $limit > 0 && $limit <= 100 ? $limit : 10;

        $books = BooksModel::selectRaw('
            SQL_NO_CACHE
            books.name,
            categories.name as category_name,
            authors.name as author_name,
            ROUND(AVG(rating), 2) as avg_rating,
            COUNT(ratings.id) as total_voter
        ')->join('authors', 'authors.id', '=', 'books.author_id')
            ->leftJoin('categories', 'categories.id', '=', 'books.category_id')
            ->leftJoin('ratings', 'ratings.book_id', '=', 'books.id');

        if ($search !== '')
            $books = $books->where(function (Builder $builder) use ($search) {
                $search = "%$search%";
                $builder->whereLike('books.name', $search)
                    ->orWhereLike('authors.name', $search);
            });

        $books = $books->groupBy('books.id')
            ->orderBy('avg_rating', 'desc')
            ->limit($limit)
            ->get();

        $data['title'] = 'Home';
        $data['books'] = $books;
        $data['search'] = $search;
        $data['current_limit'] = $limit;

        return view('home', $data);
    }
}
