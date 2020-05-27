<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function post(){
        // chaque utilisateur peut ecrire plusieurs Posts
        return $this->hasMany(Post::class);
    }

        // C'est un scoop Local qui met on ordre les users selon leur nombre
    // de posts.
    public function scopeTopUsersPost(Builder $query){
        return $query->withCount('post')->orderBy('post_count', 'desc');
    }

    // Scope Local qui permet de recuperer les listes des utilisateurs
    // qui on poster durant le mois dernier
    public function scopeActiveUserinLastMonth(Builder $query){
        // la Methode (static::CREATED_AT) sert a recuperer le champs created_at from DB
        // malgre si on change le nom (overrides)
        // ['post' => function(Builder $q){} : sert a definie une subQuery
        // qui sera appliquer sur la Table Post
        // now()->subMonths(1) : function Carbon qui permet de gerer les dates
        // ici on veut les dates depuis aujourdhui jusqu'a le mois dernier
        // ->having('post_count', '>' ,5) : permet de filtrer le resultat
        // on recuperant juste les users qui on plus de 5 post dans le mois dernier
        return  $query->withCount(['post' => function(Builder $q){
            $q->whereBetween(static::CREATED_AT, [now()->subMonths(1), now()]);
        }])->having('post_count', '>' ,5)->orderBy('post_count', 'desc');
    }

}
