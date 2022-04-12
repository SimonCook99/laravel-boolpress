<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//TABELLA PONTE, PER LA RELAZIONE MOLTI A MOLTI TRA POST E TAGS
class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->unsignedBigInteger("post_id");
            $table->foreign("post_id")->references("id")->on("posts")->onDelete("cascade");

            $table->unsignedBigInteger("tag_id");
            $table->foreign("tag_id")->references("id")->on("tags")->onDelete("cascade");

            $table->index(["post_id", "tag_id"]); //aggiunge un indice di relazione tra le 2 colonne
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
