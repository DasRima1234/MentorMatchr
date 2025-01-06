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
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('user_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_number')->nullable();  // Phone number (nullable if not provided)
            $table->text('address')->nullable();  // Address (nullable)
            $table->date('date_of_birth')->nullable();  // Date of birth (nullable)
            $table->enum('status', ['active', 'inactive', 'graduated', 'suspended'])->default('active');  // Student status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
