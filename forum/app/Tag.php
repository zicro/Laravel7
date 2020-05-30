<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // etablir la liason entre le Model Post et Le Model Tag
    // une Post Peuvent Avoir plusieur Tags
    public function posts(){
        //->withTimestamps() , sert a editer les champs updated_at|created_at in DB
        return $this->belongsToMany('App\Post')->withTimestamps();
    }
}
