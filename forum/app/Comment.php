<?php

namespace App;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    
    public function post(){
        return $this->belongsTo('App\Post');
    }

    // C'est un scoop Local qui s'applique sur les Comments
    public function scopeDernier(Builder $query){
        return $query->orderBy('updated_at', 'desc');
    }

    public static function boot(){
        parent::boot();
    
        // on ajoute le scoop qui va etre executer automatiquement
        //static::addGlobalScope(new LatestScope);
    }


}
