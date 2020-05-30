        {{-- permet d'utiliser le Componenet (card) on retournant
      la liste des top 5 post, dans cette cas on a passer les donnes
      via le $slot --}}
      <x-card title="top 5 posts : ">
        @foreach ($mostCommented as $post)
            <li class="list-group-item">
            <a href="{{ route('posts.show', ['post'=> $post->id]) }}">{{ $post->title }}</a>
            <span class="badge badge-success">{{ $post->comments_count }}</span>
        </li>

            @endforeach
     </x-card>
     {{-- permet d'utiliser le Componenet (card) on retournant la liste
     des Top 5 users via nember of posts --}}
     <x-card 
    title="top 5 Users : " 
    :items="collect($topUsersPost)->pluck('name')">
     </x-card>
     {{-- permet d'utiliser le Componenet (card) on retournant la liste
     des Top 5 users of the month --}}
     <x-card 
    title="top 5 Users of the Month : " 
    :items="collect($userMonthly)->pluck('name')">
     </x-card>