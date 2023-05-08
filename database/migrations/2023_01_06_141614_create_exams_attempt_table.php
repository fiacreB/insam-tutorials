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
        Schema::create('exams_attempt', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->foreignId('chapter_id')->references('id')->on('chapters')->onDelete('cascade')->default(0);
            $table->integer('valid')->nullable()->default(0);
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->default(0);
            $table->integer('status')->nullable()->default(0);
            $table->float('marks')->nullable();
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
        Schema::dropIfExists('exams_attempt_');
    }
};
