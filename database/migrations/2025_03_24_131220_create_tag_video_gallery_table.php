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
        Schema::create('tag_video_gallery', function (Blueprint $table) {
            $table->unsignedInteger('video_gallery_id')->index('tag_video_gallery_video_gallery_id_foreign');
            $table->unsignedInteger('tag_id')->index('tag_video_gallery_tag_id_foreign');
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
        Schema::dropIfExists('tag_video_gallery');
    }
};
