<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('email', 50);
            $table->string('image');
            $table->bigInteger('user_id');
            $table->bigInteger('major_id');
            $table->string('phone', 15)->nullable();
            $table->string('status', 10)->nullable();
            $table->string('year_of', 10)->nullable();
            $table->string('year_graduate', 10)->nullable();
            $table->longText('history')->nullable();
            $table->enum('gender', ['boy', 'girl']);
            $table->boolean('is_approved')->default(false);
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
        Schema::dropIfExists('alumni');
    }
}
