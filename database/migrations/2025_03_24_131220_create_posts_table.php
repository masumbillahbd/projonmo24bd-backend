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
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->string('uniqid',100)->nullable();
            $table->string('publisher_name')->nullable();
            $table->string('headline')->nullable();
            $table->string('single_page_headline')->nullable();
            $table->string('sub_headline')->nullable();
            $table->string('slug');
            $table->string('excerpt', 1500);
            $table->string('facebook_description')->nullable();
            $table->longText('post_content');
            $table->string('featured_image')->nullable();
            $table->string('featured_mini')->nullable();
            $table->tinyInteger('sticky');
            $table->tinyInteger('post_status')->default(0);
            $table->string('reporter_photo')->nullable();
            $table->timestamps();
            $table->unsignedInteger('last_update_by')->nullable();
            $table->timestamp('last_update_at')->nullable();
            $table->integer('view_count')->default(0);
            $table->string('featured_image_caption')->nullable();
            $table->integer('watermark')->default(0);
            $table->string('sm_image')->nullable();
            $table->integer('special')->nullable();
            $table->integer('rss')->default(1);
            $table->tinyInteger('scroll')->nullable();
            $table->smallInteger('reporter_id')->nullable();
            $table->string('video_url', 350)->nullable();
            $table->string('video_from', 350)->nullable();
            $table->string('video_id', 350)->nullable();
            $table->string('video_thumbnail', 350)->nullable();
            $table->string('podcast', 250)->nullable();
            $table->dateTime('publish_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
