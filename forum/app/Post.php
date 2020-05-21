<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // on specifier les champs qui vont être inserer dans la BDD
protected $fillable = ['title', 'content', 'slug', 'active'];

public function comments(){
    return $this->hasMany('App\Comment');
}
}
