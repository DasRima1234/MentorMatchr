<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name');
            $table->text('description')->nullable();
            $table->string('duration'); // e.g., "3 months", "1 year"
            $table->decimal('fee', 10, 2);
            $table->unsignedBigInteger('tutor_id')->nullable();
            $table->string('status')->default('Active'); // Active, Inactive
            $table->timestamps();

            $table->foreign('tutor_id')->references('id')->on('tutors')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
