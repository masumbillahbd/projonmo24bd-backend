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
        Schema::create('category_video_gallery', function (Blueprint $table) {
            $table->unsignedInteger('video_gallery_id')->index('category_video_gallery_video_gallery_id_foreign');
            $table->unsignedInteger('category_id')->index('category_video_gallery_category_id_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_video_gallery');
    }
};
