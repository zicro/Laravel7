<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOndeleteCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            // on supprime l'anciene Foregin key
            $table->dropForeign(["post_id"]);
            // on ajoute la nouvelle ForeignKey with OnDeleteCascade
            $table->foreign('post_id')
                  ->references('id')
                  ->on('posts')
                  ->onDelete('cascade');
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
             // on supprime l'anciene Foregin key qui contient with OnDeleteCascade 
             $table->dropForeign(["post_id"]);
             // on ajoute la nouvelle ForeignKey without OnDeleteCascade
             $table->foreign('post_id')
                   ->references('id')
                   ->on('posts');
        });
    }
}
