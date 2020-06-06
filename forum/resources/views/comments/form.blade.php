@auth
    <form action="{{route('posts.comments.store', ['post'=> $id])}}" method="POST">
        @csrf
    <textarea name="content" class="form-control" id="content" >{{ old('content', $post->comments()->content ?? null) }}</textarea>
        <x-errors></x-errors>
        <button type="submit" class="btn  btn-light btn-lg btn-block">add Comment</button>
    </form>


@else
<a href="{{ route('login') }}" class="btn btn-light btn-sm">sign in</a> to post a Comment!
@endauth