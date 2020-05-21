@extends('layout')

@section('content')
<h3>{{ $post->title }} </h3>
<p>{{$post->content}}</p>
    <em>{{$post->created_at}}</em>
<span>
    @if ($post->active)
    <span class="badge badge-success">active</span>
    @else
    <span class="badge badge-danger">disabled </span>    
    @endif
</span>
@endsection