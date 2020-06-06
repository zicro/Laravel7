<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class PostTagController extends Controller
{
    public function index($id){

        // the the Tag From DB
        $tag = Tag::find($id);
        return view('posts.index', [
            // utilisation du Mode Eager, (avec une seul REquetes on obtient la totalite des donnes)
            // on optimisont le nombre des request ainsi que le temps d'execution
            // a pour but d'assurer la repiditer de l'application.
            'posts' => $tag->posts()->postWithUserCommentsTagsImage()->get(),
            
        ]);
    }
}
