<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('pincode');
            $table->string('phone');
            $table->string('guardian_name');
            $table->string('guardian_phone');
            $table->date('dob');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->text('address');
            $table->enum('education_level', ['High School', 'Undergraduate', 'Graduate', 'Postgraduate']);
            $table->json('subjects'); // To handle multiple subjects
            $table->string('school_name');
            $table->string('achievements')->nullable(); // File paths for achievements
            $table->string('resources');
            $table->text('skills');
            $table->text('interests');
            $table->timestamps(); // Created At & Updated At
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
