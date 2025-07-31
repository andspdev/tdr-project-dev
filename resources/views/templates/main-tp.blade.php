<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @isset($title)
            {{ $title }} |
        @endisset Timedoor Technical Test
    </title>

    <link rel="stylesheet" href="{{ asset('./styles.css') }}">
</head>

<body>

    <div class="main-content">
        <div class="flex-grow-1">
            @yield('content')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    @yield('js')
</body>

</html>
