<?php

namespace App;

use App\Scopes\AdminShowDeleteScope;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{

    // importer le Soft Delete : 
    use SoftDeletes;



    // on specifier les champs qui vont être inserer dans la BDD
protected $fillable = ['title', 'content', 'slug', 'active', 'user_id'];

public function comments(){
    // dernier() : c'est un scoop qui est definie au niveau
    // du Model `Comment` sous le nom scopeDernier()
    return $this->hasMany('App\Comment')->dernier();
}

public function user(){
    return $this->belongsTo(User::class);
}

// une Post Peuvent Contient Plusieurs Tags
public function tags(){
    //->withTimestamps() , sert a editer les champs updated_at|created_at in DB
    return $this->belongsToMany('App\Tag')->withTimestamps();
}

 // C'est un scoop Local qui met on ordre les posts selon leur nombre
 // de comments.
 public function scopeMostCommented(Builder $query){
    return $query->withCount('comments')->orderBy('comments_count', 'desc');
}




public static function boot(){
    

    // on ajoute le scoop qui va etre executer automatiquement
    static::addGlobalScope(new AdminShowDeleteScope);

    parent::boot();
    
    // on ajoute le scoop qui va etre executer automatiquement
    static::addGlobalScope(new LatestScope);

    static::deleting(function (Post $post){
        // lors du lancement de la request delete, on supprimer d'abord les
        //Commentaire de la post pour luter contre le foreign key
        # on utilise la function comments() pour avoir les commentaire
        # liee au Current post 
        // if we use onDeleteCascade we don't use this Code
        $post->comments()->delete();
    });

    // on utilise La MEthode restoring(), pour restorer les Commentaires
    // aussi avec les posts : 

    static::restoring(function (Post $post) {
        $post->comments()->restore();
    });

    // au moment du modification du Post, on va supprimer le cache
    // qui sert a afficher le cotenue du post, pour que l'affichage
    // se recupere les donner depuis la BDD (new valeur modifier)
    static::updating(function (Post $post) {
        // ici on a post-show-{$id} : le nom du cache qu'on vent supprimer
        Cache::forget("post-show-{$post->id}");
    });
}

}
