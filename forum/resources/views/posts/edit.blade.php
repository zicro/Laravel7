@extends('layouts.app')

@section('content')
<h1>Edit Post  </h1>
<form action="{{route('posts.update', ['post' => $post->id])}}" method="POST">
    @csrf
    @method('PUT')
       @include('posts.form')
        <button type="submit" class="btn  btn-success btn-lg btn-block" btn-lg btn-block">Edit post</button>
    </form>
@endsection