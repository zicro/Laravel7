@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-8">

        
        <h2 style="color:#ccc;" class="text-center">Nombre de Posts : {{ $posts->count() }}</h2>
        
        <h3>Post list : </h3>
            <ul class="list-group">    
                @forelse ($posts as $post)
            <li class="list-group-item">

                @if ($post->created_at->diffInHours() < 1)                    
                   <x-badge type="success"> New </x-badge>
                @else
                   <x-badge type="warning"> Old </x-badge>
                @endif


                {{-- l'ecriture : {{route('posts.show', ['post' => $post->id])}} 
                ( avec post le nom de parameters et $post->id sa valeur)
                est egale a posts/$post->id --}}
                <h3><a href="{{route('posts.show', ['post' => $post->id])}}">
                    @if ($post->trashed())
                    <del>
                    {{ $post->title }}
                    </del>
                    @else
                    {{ $post->title }}
                    @endif
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
            <x-updated :date="$post->updated_at" :name="$post->user->name"></x-updated>
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
    </div>
    <div class="col-4" style="margin-top: 6em;">
       <x-card 
       title="top 5 posts : " 
       :items="collect($mostCommented)->pluck('title')">
        </x-card>

        <x-card 
       title="top 5 Users : " 
       :items="collect($topUsersPost)->pluck('name')">
        </x-card>

        <x-card 
       title="top 5 Users of the Month : " 
       :items="collect($userMonthly)->pluck('name')">
        </x-card>

        <div class="card mt-4">
            
            <div class="card-body">
                <h4 class="card-title">Top 5 Users By Post : </h4>
                
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($topUsersPost as $user)
                <li class="list-group-item">
                {{ $user->name }}
                <span class="badge badge-success">{{ $user->post_count }}</span>
            </li>

                @endforeach
                
            </ul>
        </div>


        <div class="card mt-4">
            
            <div class="card-body">
                <h4 class="card-title">Top 5 Users Last month : </h4>
                
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($userMonthly as $user)
                <li class="list-group-item">
                {{ $user->name }}
                <span class="badge badge-success">{{ $user->post_count }}</span>
            </li>

                @endforeach
                
            </ul>
        </div>


    </div>
</div>



@endsection