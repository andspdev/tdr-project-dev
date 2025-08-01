@extends('templates.main-tp')

@section('content')
    <div class="center-content">
        <form method="get" action="{{ route('home') }}">
            <table class="mb-3">
                <tbody>
                    <tr>
                        <td>
                            <label for="list-shown">List shown</label>
                        </td>
                        <td>:</td>
                        <td>
                            <select id="list-shown" name="limit">
                                <option value="">Choose :</option>

                                @for ($i = 10; $i <= 100; $i += 10)
                                    <option value="{{ $i }}" {{ $i === (int) $current_limit ? ' selected' : '' }}>
                                        {{ $i }}</option>
                                @endfor
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td><label for="search">Search</label></td>
                        <td>:</td>
                        <td>
                            <input type="text" name="q" id="search" class="search-text"
                                value="{{ $search }}">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2"></td>
                        <td>
                            <button type="submit">Search</button><br /><br />

                            <a href="{{ route('top_authors') }}">Top 10 Most Famous Author</a><br />
                            <a href="{{ route('insert_rating.index') }}">Insert Rating</a><br />
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

        @if ($books->isEmpty())
            No data added.
        @else
            @if (session()->has('success_save_rating'))
                <div class="mb-1">
                    <span style="color: green">{{ session()->get('success_save_rating') }}</span>
                </div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Book Name</th>
                        <th>Category Name</th>
                        <th>Author Name</th>
                        <th>Average Rating</th>
                        <th>Voter</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $i => $book)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>{{ $book->name ?? '-' }}</td>
                            <td>{{ $book->category_name ?? '-' }}</td>
                            <td>{{ $book->author_name ?? '-' }}</td>
                            <td class="text-center">{{ $book->avg_rating ?? '0' }}</td>
                            <td class="text-center">{{ $book->total_voter ?? '0' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
