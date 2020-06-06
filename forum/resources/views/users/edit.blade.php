@extends('layouts.app')

@section('content')
    {{-- form>.row>.col-md>h5{Select avatar}+img.img-thumbnail+input:file.form-control-file^.col-md-8>.form-group>label+input#name.form-control --}}
<form action="{{ route('users.update', ['user', $user->id]) }}" method="POST" enctype="multipart/form-data">
@method('PUT')
@csrf    
    <div class="row">
            <div class="col-md">
                <h5>Select avatar</h5>
                <img src="" alt="" class="img-thumbnail">
                <input type="file" name="avatar" id="avatar" class="form-control-file">
            </div>
            <div class="col-md-8">
                <div class="form-group"><label for="name"></label>
                <input type="text" value="{{ $user->name }}" id="name" name="name" class="form-control"></div>
            </div>
        </div>
    </form>
@endsection