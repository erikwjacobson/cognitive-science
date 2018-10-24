<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->float('credits');
            $table->integer('department_id')->unsigned();
            $table->integer('course_type_id')->unsigned();
            $table->integer('degree_id')->unsigned();
            $table->float('requirement_score');
            $table->timestamps();

            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
            $table->foreign('course_type_id')
                ->references('id')
                ->on('course_types');
            $table->foreign('degree_id')
                ->references('id')
                ->on('degrees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
