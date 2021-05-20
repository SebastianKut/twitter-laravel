<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tweet_id')->constrained()->onDelete('cascade'); //this is newer way but the same as '$table->foreign('tweet_id')->references('id')->on('tweets')->onDelete('cascade');'
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('liked');
            $table->timestamps();

            //prevent the user to like and dislike the same tweet by adding unique constraint that we can only have one record of user - tweet relationship
            $table->unique(['tweet_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
