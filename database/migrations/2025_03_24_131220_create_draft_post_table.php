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
        Schema::create('draft_post', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('draft_id')->index('draft_post_draft_id_foreign');
            $table->bigInteger('post_id')->index('draft_post_post_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('draft_post');
    }
};
