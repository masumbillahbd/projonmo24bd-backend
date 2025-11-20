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
        Schema::create('schedule_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('headline')->nullable();
            $table->string('sub_headline')->nullable();
            $table->string('excerpt', 750)->nullable();
            $table->longText('post_content')->nullable();
            $table->integer('sticky_position')->nullable();
            $table->tinyInteger('rss')->nullable();
            $table->tinyInteger('scroll')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('featured_image_caption')->nullable();
            $table->string('video_url')->nullable();
            $table->string('video_from')->nullable();
            $table->string('video_id')->nullable();
            $table->string('video_thumbnail')->nullable();
            $table->integer('reporter_id')->nullable();
            $table->string('reporter_photo')->nullable();
            $table->string('tag_list')->nullable();
            $table->json('category_id')->nullable();
            $table->json('sub_category_id')->nullable();
            $table->json('division_id')->nullable();
            $table->json('district_id')->nullable();
            $table->json('upazila_id')->nullable();
            $table->string('banner')->nullable();
            $table->tinyInteger('post_status')->nullable();
            $table->dateTime('publish_time')->nullable();
            $table->timestamps();
            $table->string('featured_mini')->nullable();
            $table->string('podcast')->nullable();
            $table->tinyInteger('special')->nullable();
            $table->tinyInteger('sticky')->nullable();
            $table->integer('user_id')->nullable();
        });
    }


    public function down()
    {
        Schema::dropIfExists('schedule_posts');
    }
};
