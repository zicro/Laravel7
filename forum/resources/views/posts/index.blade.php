@extends('layouts.app')

@section('content')

<nav class="nav nav-tabs nav-stacked my-5">
    <a class="nav-link  @if ($tab == 'list') active @endif " href="/posts">List</a>
    <a class="nav-link  @if ($tab == 'archive') active @endif" href="/posts/archive">Archive</a>
    <a class="nav-link  @if ($tab == 'all') active @endif" href="/posts/all">All</a>
</nav>

<h2 style="color:#ccc;" class="text-center">Nombre de Posts : {{ $posts->count() }}</h2>

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
    <em>{{$post->updated_at->diffForHumans()}}, by {{ $post->user->name }}</em>
    <br >

    @cannot('delete', $post)
        <span class="badge badge-dark">you can't Delete it ...</span>
    @endcannot

    
    @can('update', $post)
    <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post->id]) }}" >edit</a>
    @endcan

    @if ($post->deleted_at)

    @can('restore', $post)
    <form style="display:inline;" action="{{url('/posts/'.$post->id.'/restore')}}" method="POST">
        @csrf
        @method('PATCH')
            <button type="submit" class="btn btn-success">
                restore</button>
        </form>
    @endcan
            
        @can('forceDelete', $post)
        <form style="display:inline;" action="{{url('/posts/'.$post->id.'/forcedelete')}}" method="POST">
            @csrf
            @method('DELETE')
                <button type="submit" class="btn btn-warning">
                    !Delete</button>
            </form>
            @endcan
    @else

    @can('delete', $post)
    <form style="display:inline;" action="{{route('posts.destroy', ['post' => $post->id])}}" method="POST">
        @csrf
        @method('DELETE')
            <button type="submit" class="btn btn-danger">
                Delete</button>
        </form>
        @endcan

    @endif
   
    </li>
    


        @empty
            <span class="badge badge-danger">There is no Post yet</span>
        @endforelse
    </ul>
@endsection