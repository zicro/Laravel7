<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    // importer le Soft Delete : 
    use SoftDeletes;



    // on specifier les champs qui vont être inserer dans la BDD
protected $fillable = ['title', 'content', 'slug', 'active'];

public function comments(){
    return $this->hasMany('App\Comment');
}

public function user(){
    // chaque post apartient a un seul utilisateur
    return $this->belongsTo(User::class);
}

public static function boot(){
    parent::boot();

    static::deleting(function (Post $post){
        // lors du lancement de la request delete, on supprimer d'abord les
        //Commentaire de la post pour luter contre le foreign key
        # on utilise la function comments() pour avoir les commentaire
        # liee au Current post 
        // if we use onDeleteCascade we don't use this Code
        //$post->comments()->delete();
    });

    // on utilise La MEthode restoring(), pour restorer les Commentaires
    // aussi avec les posts : 

    static::restoring(function (Post $post) {
        $post->comment()->restore();
    });
}

}
