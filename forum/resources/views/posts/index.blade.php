@extends('layout')

@section('content')
<h3>Post list : </h3>
    <ul class="list-group">    
        @forelse ($posts as $post)
    <li class="list-group-item">
        {{-- l'ecriture : {{route('posts.show', ['post' => $post->id])}} 
        ( avec post le nom de parameters et $post->id sa valeur)
        est egale a posts/$post->id --}}
        <h3><a href="{{route('posts.show', ['post' => $post->id])}}">
            {{ $post->title }}
        </a></h3>

        <p>{{$post->content}}</p>
    <span class="badge badge-success">
        @if ($post->comments_count == 0)
            no Comment.
        @elseif($post->comments_count == 1)
        {{$post->comments_count}} Comment
        @else
        {{$post->comments_count}} Comments   
        @endif
       </span>
    <em>{{$post->created_at->diffForHumans()}}</em>
    <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post->id]) }}" >edit</a>
    
    <form style="display:inline;" action="{{route('posts.destroy', ['post' => $post->id])}}" method="POST">
        @csrf
        @method('DELETE')
            <button type="submit" class="btn btn-danger" btn-lg btn-block">
                Delete</button>
        </form>
    </li>
    


        @empty
            <span class="badge badge-danger">There is no Post yet</span>
        @endforelse
    </ul>
@endsection