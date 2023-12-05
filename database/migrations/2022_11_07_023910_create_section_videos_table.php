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
        Schema::create('section_videos', function (Blueprint $table) {
            $table->id();
            $table->string('id_section')->unique();
            $table->string('title_one')->nullable();
            $table->text('title_two')->nullable();
            $table->string('title_three')->nullable();
            $table->string('title_four')->nullable();
            $table->string('video_url');
            $table->string('background');
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
        Schema::dropIfExists('section_videos');
    }
};
