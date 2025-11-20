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
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('admin_prefix')->nullable();
            $table->string('site_url')->nullable();
            $table->string('site')->nullable();
            $table->string('site_title')->nullable();
            $table->string('site_email')->nullable();
            $table->string('cr_text_1')->nullable();
            $table->string('cr_text_2')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_image')->nullable();
            $table->string('fb_app_id')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('instagram')->nullable();
            $table->mediumText('live_streaming_code')->nullable();
            $table->boolean('streaming_status')->nullable();
            $table->timestamps();
            $table->string('site_mobile')->nullable();
            $table->string('google_map', 1000)->nullable();
            $table->string('google_analytic', 1000)->nullable();
            $table->string('google_adsense', 1000)->nullable();
            $table->string('linkedin')->nullable();
            $table->string('lazy_image')->nullable();
            $table->string('share_banner', 350)->nullable();
            $table->integer('share_banner_status')->default(0);
            $table->tinyInteger('scroll_bar')->default(0);
            $table->tinyInteger('desktop_menu_bar')->default(0);
            $table->tinyInteger('popular_tag')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
