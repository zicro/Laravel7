@foreach ($tags as $tag)
<span class="badge badge-dark"><a href="{{ route('posts.tag.index', ['id' => $tag->id]) }}" style="color:white;">{{$tag->name}}</a></span>
@endforeach