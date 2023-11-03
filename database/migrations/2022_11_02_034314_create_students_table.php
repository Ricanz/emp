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
            $table->string('nim', 10)->unique();
            $table->string('name', 50);
            $table->string('email', 50);
            $table->bigInteger('user_id');
            $table->bigInteger('major_id');
            $table->bigInteger('mitra_id');
            $table->bigInteger('dpa')->nullable();
            $table->bigInteger('dpl')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->string('year', 4)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('status', 10)->nullable();
            $table->enum('gender', ['boy', 'girl']);
            $table->boolean('is_alumni')->default(false);
            $table->longText('history')->nullable();
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
        Schema::dropIfExists('students');
    }
}
