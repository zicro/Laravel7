<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/theme.css') }}">
    <title>Document</title>
</head>
<body>
    @if (session()->has('status'))
        {{session()->get('status')}}
    @endif

    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="{{ route('about') }}">about</a>
            <a class="nav-item nav-link" href="{{ route('posts.index') }}">List Post</a>
            <a class="nav-item nav-link" href="{{ route('posts.create') }}">New Post</a>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>

<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>