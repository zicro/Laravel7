@extends('layouts.app')

@section('content')
    {{-- ici on recupere les donnes transmet depuis la route from web.php --}}
    {{ $data['title'] }}

<p>the author is : {{ $author }}</p>
@endsection