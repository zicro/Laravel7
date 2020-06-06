<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // generate 10 users
       $users = factory(App\User::class, 10)->create();

       // generer 300 post
       // et on boucle sur chaque post on lui affectant un User_id
       $posts = factory(App\Post::class, 50)->make()->each(function($post) use($users){
           $post->user_id = $users->random()->id;
           $post->save();
       });

       // generer 1000 Comments
       // et on boucle sur chaque Comment on lui affectant un post_id

       factory(App\Comment::class, 150)->make()->each(function($comment) use($posts, $users){
           $comment->post_id = $posts->random()->id;
           $comment->user_id = $users->random()->id;
           $comment->save();
       });

       // on faire appel au TagTableSeeder et PostTagTableSeeder
       //  pour qu'il seront executer:
       $this->call([
        TagTableSeeder::class,
        PostTagTableSeeder::class,
       ]);

       
    }
}
