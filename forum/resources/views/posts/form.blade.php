<div class="form-group">
    <label for="title">
        title
    </label>
    <input class="form-control" name="title" type="text" id="title" value="{{ old('title', $post->title ?? null ) }}">
</div>
<div class="form-group">
    <label for="content">
        content
    </label>
    <textarea class="form-control" name="content" id="content">{{ old('content', $post->content ?? null) }}</textarea>
</div>
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
       
    </ul>
@endif