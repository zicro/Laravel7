{{-- <em>{{$date->diffForHumans()}}, by <a href="{{ route('users.show', ['user' => $user]) }}">ss</a></em> --}}

<em>{{$date->diffForHumans()}}</em>
{!! isset($name) ? ', by <a href="'.route('users.show', ['user' => $userId]).'">'.$name.'</a>' : null !!}

