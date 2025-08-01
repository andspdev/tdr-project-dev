<?php

namespace App\Http\Controllers;

use App\Models\AuthorsModel;
use App\Models\BooksModel;
use App\Models\RatingsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Log;

class InsertRatingsController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Insert Rating';

        $authors = AuthorsModel::orderBy('name')->paginate(10, ['id', 'name'], 'authors_page');
        $data['authors'] = $authors;

        $selected_author = $request->get('selected_author');
        $selected_book = $request->get('selected_book');

        $books = BooksModel::where('author_id', $selected_author)
            ->orderBy('name')
            ->paginate(10, ['id', 'name'], 'books_page')
            ->appends([
                'authors_page' => $authors->currentPage(),
                'selected_author' => $selected_author
            ]);
        $data['books'] = $books;

        $data['selected_author'] = $selected_author;
        $data['selected_book'] = $selected_book;

        return view('insert-ratings', $data);
    }

    private function validate_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'author_id' => [
                'required',
                function ($attr, $val, $fail) {
                    $check_exists = AuthorsModel::selectRaw(1)->where('id', $val)->exists();

                    if (!$check_exists) {
                        $fail('Please select an available authors.');
                    }
                }
            ],
            'book_id' => [
                'required',
                function ($attr, $val, $fail) {
                    $check_exists = BooksModel::selectRaw(1)->where('id', $val)->exists();

                    if (!$check_exists) {
                        $fail('Please select an available books.');
                    }
                }
            ],
            'rating' => [
                'required',
                'integer',
                'min:1',
                'max:10'
            ]
        ], [
            'author.required' => 'The author field is required.',
            'books.required' => 'The book field is required.',

            'rating' => [
                'required' => 'The rating field is required.',
                'integer' => 'The rating must be a number.',
                'min' => 'The rating must be between 1 and 10.',
                'max' => 'The rating must be between 1 and 10.'
            ]
        ]);

        return $validator;
    }

    public function store(Request $request)
    {
        try {
            $validator = $this->validate_store($request);

            if ($validator->fails())
                return redirect()->back()->withErrors($validator->errors())->withInput();

            $validated = $validator->validated();

            RatingsModel::create($validated);

            return redirect()->route('home')->with('success_save_rating', 'You have successfully rated the book you selected.');
        } catch (\Exception $e) {
            Log::error($e);
            abort(500);
        }
    }
}
