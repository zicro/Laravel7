<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    // declare les champs qui vont être enregistere dans la BDD
    protected $fillable = ['path'];
    //declare the relation between Posts & users table and Images
    public function imageable(){
        return $this->morphTo();
    }

    // methode that return the Image url:
    public function url(){
        return Storage::url($this->path);
    }
    
}
