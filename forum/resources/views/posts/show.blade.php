@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-8">
<img class="img-fluid roundred" src="{{env('APP_URL').'/storage/'}}{{$post->image->path ?? null}}" alt="">
  <h3>{{ $post->title }} </h3>
<p>{{$post->content}}</p>
    
Tags : <x-tags :tags="$post->tags"></x-tags> <br />
<x-updated :date="$post->updated_at" :name="$post->user->name" :userId="$post->user_id"></x-updated>
    
<span>
    @if ($post->active)
    <span class="badge badge-success">active</span>
    @else
    <span class="badge badge-danger">disabled </span>    
    @endif
</span>



@if ($post->comments->count() >0)
    
<h3>Comments : </h3>
@include('comments.form', ['id' => $post->id])
@foreach ($post->comments as $comment)

<div class="list-group-item">
<p>{{$comment->content}}</p>

<x-updated :date="$post->updated_at" :name="$post->user->name" :userId="$post->user_id"></x-updated>
</div>
@endforeach


@endif

    </div>
    <div class="col-4">
        @include('posts.sidebar')
    </div>
</div>



@endsection