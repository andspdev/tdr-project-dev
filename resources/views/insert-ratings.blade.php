@extends('templates.main-tp')

@section('content')
    <div class="center-content">
        <div class="text-center mb-3">
            <h2>Insert Rating</h2>
        </div>

        <div class="mb-1">
            <a href="{{ route('home') }}">&laquo; Back</a>
        </div>

        <form method="post" action="{{ route('insert_rating.store') }}">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <label for="author">
                                Book Author
                            </label>
                        </td>
                        <td>:</td>
                        <td>
                            <select name="author_id" id="author" {{ $authors->isEmpty() ? ' disabled' : '' }}>
                                <option value="">Choose :</option>

                                @if ($authors->previousPageUrl())
                                    <optgroup label="Page">
                                        <option value="prev_page">&laquo; Previous Authors</option>
                                    </optgroup>
                                @endif

                                <optgroup label="Authors">
                                    @foreach ($authors as $author)
                                        <option value="{{ $author->id }}"
                                            {{ $author->id == $selected_author ? 'selected' : '' }}>{{ $author->name }}
                                        </option>
                                    @endforeach
                                </optgroup>

                                @if ($authors->hasMorePages())
                                    <optgroup label="Page">
                                        <option value="next_page">Next Authors &raquo;</option>
                                    </optgroup>
                                @endif
                            </select>

                            @error('author_id')
                                <br />
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="book-name">
                                Book Name
                            </label>
                        </td>
                        <td>:</td>
                        <td>
                            @php $disabled_book = $books->isEmpty() || !$selected_author @endphp
                            <select name="book_id" id="book-name" {{ $disabled_book ? ' disabled' : '' }}>
                                <option value="">Choose :</option>

                                @if ($books->previousPageUrl())
                                    <optgroup label="Page">
                                        <option value="prev_page">&laquo; Previous Books</option>
                                    </optgroup>
                                @endif

                                <optgroup label="Books">
                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}"
                                            {{ $book->id == $selected_book ? 'selected' : '' }}>
                                            {{ $book->name }}</option>
                                    @endforeach
                                </optgroup>

                                @if ($books->hasMorePages())
                                    <optgroup label="Page">
                                        <option value="next_page">Next Books &raquo;</option>
                                    </optgroup>
                                @endif
                            </select>

                            @if (!$disabled_book)
                                @error('book_id')
                                    <br />
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="rating">
                                Rating
                            </label>
                        </td>
                        <td>:</td>
                        <td>
                            @php $disabled_rating = $books->isEmpty() || !$selected_book @endphp
                            <select name="rating" id="rating" {{ $disabled_rating ? ' disabled' : '' }}>
                                <option value="">Choose :</option>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>

                            @if (!$disabled_rating)
                                @error('rating')
                                    <br />
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td>
                            @csrf
                            <button type="submit">Submit</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script type="text/javascript">
        $(function() {
            const mainUrlPage = '{{ route('insert_rating.index') }}';

            $('#author').change(function() {
                const value = $(this).val();
                const prev_page = '{{ $authors->previousPageUrl() }}';
                const next_page = '{{ $authors->nextPageUrl() }}';

                if (value === 'prev_page') {
                    window.location.href = prev_page;
                } else if (value === 'next_page') {
                    window.location.href = next_page;
                } else {
                    window.location.href =
                        `${mainUrlPage}?authors_page={{ $authors->currentPage() }}&` +
                        `selected_author=${value}`
                }
            });

            $('#book-name').change(function() {
                const value = $(this).val();
                const prev_page = '{!! $books->previousPageUrl() !!}';
                const next_page = '{!! $books->nextPageUrl() !!}';

                if (value === 'prev_page') {
                    window.location.href = prev_page;
                } else if (value === 'next_page') {
                    window.location.href = next_page;
                } else {
                    window.location.href =
                        `${mainUrlPage}?authors_page={{ $authors->currentPage() }}&` +
                        `books_page={{ $books->currentPage() }}&` +
                        `selected_author={{ $selected_author }}&` +
                        `selected_book=${value}`
                }
            });
        });
    </script>
@endsection
