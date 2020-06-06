<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostCommentController extends Controller
{
    //create insert method store()
    public function store(StoreComment $request, Post $post){
        $post->comments()->create([
            'content' => $request->content,
            'post_id' => $post->id,
            'user_id' => $request->user()->id,
        ]);


        return redirect()->back();
    }
}
