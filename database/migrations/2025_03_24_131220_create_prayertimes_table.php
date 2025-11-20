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
        Schema::create('prayertimes', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('fajr', 30)->nullable();
            $table->string('zuhr', 30)->nullable();
            $table->string('asr', 30)->nullable();
            $table->string('maghrib', 30)->nullable();
            $table->string('isha', 30)->nullable();
            $table->string('sun_rise', 30)->nullable();
            $table->string('sun_set', 30)->nullable();
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
        Schema::dropIfExists('prayertimes');
    }
};
