<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('parent_id')->constrained('parents');
            $table->foreignId('class_id')->constrained('grades');
            $table->unsignedBigInteger('roll_number');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('phone');
            $table->date('dateofbirth');
            $table->string('current_address');
            $table->string('permanent_address');
            $table->string('paid');
            $table->string('note');
            $table->timestamps();
            $table->unsignedBigInteger('evaluation');
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
