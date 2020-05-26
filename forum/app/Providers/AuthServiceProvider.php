<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        ## using Policies : 
        Gate::define('secret.page', function($user){
            return $user->is_admin;
        });

        // Gate::define('post.update', 'App\Policies\PostPolicy@update');
        // Gate::define('post.delete', 'App\Policies\PostPolicy@delete');

        ## on peut aussi utiliser resources pour generer les Routes  auto
        //Gate::resource('post', 'App\Policies\PostPolicy');

        //on verifier si l'utilisateur en cours (logged in)
        // possede le Post qu'il veut modifier
        // on comparrent le Id du user logged in With
        // the Post user_id 
        # 1 - le premier parameters et un nom de notre choix
        # 2 - function anonym qui sert a comparer les Id's
        // Gate::define("post.update", function($user, $post){
        //     return $user->id === $post->user_id;
        // });

        // de la meme maniere pour la suppression
        // Gate::define("post.delete", function($user, $post){
        //     return $user->id === $post->user_id;
        // });
        
        // permet de tester si l'user connecter est un ADMIN
        // si oui on lui donne les privileges de Controller
        Gate::before(function($user, $ability){
            if ($user->is_admin && in_array($ability, ["update", "restore", "delete" ,"forcedelete"])) {
                return true;
            }
        });
    }
}
