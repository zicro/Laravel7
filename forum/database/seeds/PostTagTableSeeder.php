<?php

use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //connectre le nombre de tags exist dans la BDD
        $tagsCount = Tag::count();

        // on recupere les posts et on boucle sur eux on lui affectant des Tags
        Post::all()->each(function($post) use($tagsCount){
        
           $take = random_int(1,$tagsCount);
           // retourner un tableau des ID's des Tags d'une maniere aleatoire: 
           $tagsIds = Tag::inRandomOrder()->take($take)->get()->pluck('id');
          $post->tags()->sync($tagsIds);
        });
    }
}
