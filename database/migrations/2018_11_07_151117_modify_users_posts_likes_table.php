<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUsersPostsLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_posts_likes', function (Blueprint $table) {
          $table->dropForeign('users_posts_likes_post_id_foreign');
          $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_posts_likes', function (Blueprint $table) {
          $table->foreign('post_id')->references('id')->on('posts')->change();
        });
    }
}
