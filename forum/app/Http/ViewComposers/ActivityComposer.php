<?php

namespace App\Http\ViewComposers;
 
use App\Post;
use App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ActivityComposer{

        public function compose(View $view){
           
            $top5Posts = Cache::remember('top5Posts', now()->addMinutes(20), function(){
                return Post::mostCommented()->take(5)->get();
            });
    
            $topUsersPost = Cache::remember('topUsersPost', now()->addMinutes(20), function(){
                return User::topUsersPost()->take(5)->get();
            });
    
    
            $userMonthly = Cache::remember('userMonthly', now()->addMinutes(90), function(){
                return User::activeUserinLastMonth()->take(5)->get();
            });

            $view->with([
               
                'mostCommented' => $top5Posts,
                'topUsersPost' => $topUsersPost,
                'userMonthly' => $userMonthly,
            ]);
        }
}