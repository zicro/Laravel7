<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentsToPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            //create a foreign id between comments And Posts
            // $table->unsignedBigInteger('post_id')->unique();
            // $table->foreign('post_id')->references('id')->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
           // annuler la foreignKey
        //    $table->dropForeign('comments_post_id_foreign');
        //    $table->dropColumn(['post_id']);
        });
    }
}
