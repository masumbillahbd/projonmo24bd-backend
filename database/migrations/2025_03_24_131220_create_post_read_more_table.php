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
        Schema::create('post_read_more', function (Blueprint $table) {
            $table->unsignedInteger('post_id')->index('post_read_more_post_id');
            $table->unsignedInteger('read_more_id')->unique('post_read_more_read_more_id');
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
        Schema::dropIfExists('post_read_more');
    }
};
