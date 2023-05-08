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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->foreignId('course_id')->references('id')->on('courses')->onDelete('cascade')->default(0);
            $table->string('title');
            $table->text('description');
            $table->string('first')->default('No');
            $table->float('marks')->default(0);
            $table->float('pass_marks')->default(0);
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
        Schema::dropIfExists('chapters');
    }
};
