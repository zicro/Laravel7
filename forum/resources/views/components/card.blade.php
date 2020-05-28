<div class="card mt-4">
            
    <div class="card-body">
        <h4 class="card-title">{{$title}} </h4>
        
    </div>
    <ul class="list-group list-group-flush">
        @foreach ($items as $item)
        <li class="list-group-item">
            {{ $item }}
        </li>
        @endforeach
    </ul>
</div>