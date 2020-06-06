@extends('layouts.app')

@section('content')
  
    <div class="row">
            <div class="col-md">
                <h5>Select avatar</h5>
                <img src="" alt="" class="img-thumbnail avatar">
                
            </div>
            <div class="col-md-8">
                <div class="form-group"><label for="name"></label>
                <h4>{{ $user->name }}</h4>
            </div>
        </div>

@endsection