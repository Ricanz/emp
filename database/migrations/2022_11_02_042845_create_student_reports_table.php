<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id');
            $table->bigInteger('week_id');
            $table->string('title')->nullable();
            $table->string('reports')->nullable();
            $table->string('type')->nullable();
            $table->boolean('approved_by_lecturer')->default(false);
            $table->boolean('approved_by_partner')->default(false);
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('intern_date')->nullable();
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
        Schema::dropIfExists('student_reports');
    }
}
