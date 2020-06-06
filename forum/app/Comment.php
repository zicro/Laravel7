<?php

namespace App;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use SoftDeletes;

    // on specifier les champs qui vont être inserer dans la BDD
    protected $fillable= ['content', 'user_id', 'post_id'];

    public function post(){
        return $this->belongsTo('App\Post');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }

    // C'est un scoop Local qui s'applique sur les Comments
    public function scopeDernier(Builder $query){
        return $query->orderBy('updated_at', 'desc');
    }

    public static function boot(){
        parent::boot();
    
        // on ajoute le scoop qui va etre executer automatiquement
        //static::addGlobalScope(new LatestScope);

        // au moment du creation d'un nouveau Comment, on va supprimer le cache
    //  pour que l'affichage se recupere les donner depuis la BDD 
    // (new valeur ajouter)
    static::creating(function (Comment $comment) {
        // ici on a post-show-{$id} : le nom du cache qu'on vent supprimer
        Cache::forget("post-show-{$comment->post->id}");
    });
    }


}
