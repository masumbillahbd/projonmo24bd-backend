<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trashposts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('publisher_name')->nullable();
            $table->string('headline')->nullable();
            $table->string('single_page_headline')->nullable();
            $table->string('sub_headline')->nullable();
            $table->string('slug')->nullable();
            $table->mediumText('excerpt');
            $table->string('facebook_description')->nullable();
            $table->longText('post_content');
            $table->string('featured_image')->nullable();
            $table->string('featured_mini')->nullable();
            $table->tinyInteger('sticky')->default(0);
            $table->tinyInteger('post_status')->default(0);
            $table->string('reporter_photo')->nullable();
            $table->timestamps();
            $table->tinyInteger('last_update_by')->nullable();
            $table->integer('view_count')->default(0);
            $table->string('featured_image_caption')->nullable();
            $table->string('sm_image')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->integer('rss')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trashposts');
    }
};
