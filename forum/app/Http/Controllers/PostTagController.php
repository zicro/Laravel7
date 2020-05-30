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
            'posts' => $tag->posts,
            
        ]);
    }
}
