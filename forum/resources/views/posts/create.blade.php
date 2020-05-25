@extends('layouts.app')

@section('content')
<h1>Add New Post  </h1>
<form action="{{route('posts.store')}}" method="POST">
    @csrf
    @include('posts.form')
        <button type="submit" class="btn  btn-primary btn-lg btn-block">add post</button>
    </form>
@endsection