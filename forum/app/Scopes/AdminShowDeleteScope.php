<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class AdminShowDeleteScope implements Scope{
    
    
    public function apply(Builder $builder, Model $model){
        // Auth::check() : on verifier si l'user et authentifier
        // Auth::user()->is_admin : si l'user authentifier est un admin
        if (Auth::check() && Auth::user()->is_admin) {
            # on va recuperer la liste des Posts avec seul qui on ete supprimer
            $builder->withTrashed();   
        }
    }
}