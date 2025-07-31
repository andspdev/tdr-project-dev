@extends('templates.main-tp')

@section('content')
    <div class="center-content">
        <div class="text-center mb-3">
            <h2>Top 10 Most Famous Author</h2>
        </div>

        <div class="mb-1">
            <a href="{{ route('home') }}">&laquo; Back</a>
        </div>

        @if ($authors->isEmpty())
            No data added.
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 80px">No</th>
                        <th>Author Name</th>
                        <th>Voter</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($authors as $i => $author)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>{{ $author->name ?? '-' }}</td>
                            <td class="text-center">{{ $author->total_voter ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
