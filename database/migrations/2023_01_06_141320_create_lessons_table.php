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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->default('null');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('visits')->default(0);
            $table->string('video_path')->default('null');
            $table->string('video_provider')->default('null');
            $table->string('video_link')->default('null');
            $table->foreignId('chapter_id')->references('id')->on('chapters')->onDelete('cascade')->default(0);
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
        Schema::dropIfExists('lessons');
    }
};
