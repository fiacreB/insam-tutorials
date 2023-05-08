<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams_answers', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->foreignId('attempt_id')->references('id')->on('exams_attempt')->onDelete('cascade')->default(0);
            $table->foreignId('question_id')->references('id')->on('questions')->onDelete('cascade')->default(0);
            $table->foreignId('answer_id')->references('id')->on('answers')->onDelete('cascade')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams_answers');
    }
};
