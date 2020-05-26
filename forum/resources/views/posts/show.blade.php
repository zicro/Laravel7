@extends('layouts.app')

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


@if ($post->comments->count() >0)
    
<h3>Comments : </h3>
@foreach ($post->comments as $comment)

<div class="list-group-item">
<p>{{$comment->content}}</p>
<em>{{$comment->updated_at}}</em>
</div>
@endforeach


@endif



@endsection