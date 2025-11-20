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
        Schema::create('drafts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('publisher_name')->nullable();
            $table->string('headline')->nullable();
            $table->string('single_page_headline')->nullable();
            $table->string('sub_headline')->nullable();
            $table->string('slug')->nullable();
            $table->string('excerpt')->nullable();
            $table->string('facebook_description')->nullable();
            $table->string('post_content')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('featured_mini')->nullable();
            $table->tinyInteger('sticky')->nullable();
            $table->tinyInteger('post_status')->nullable();
            $table->string('reporter_photo')->nullable();
            $table->timestamps();
            $table->integer('last_update_by')->nullable();
            $table->timestamp('last_update')->nullable();
            $table->string('featured_image_caption')->nullable();
            $table->integer('watermark')->nullable();
            $table->string('sm_image')->nullable();
            $table->integer('special')->nullable();
            $table->string('sub_cat_id', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drafts');
    }
};
