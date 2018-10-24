<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->string('credits');
            $table->integer('course_type_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->float('requirement_score');
            $table->timestamps();

            $table->foreign('course_type_id')
                ->references('id')
                ->on('course_types');
            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
        });

        Schema::create('course_meta_course', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned();
            $table->integer('meta_course_id')->unsigned();
            $table->timestamps();

            $table->foreign('course_id')
                ->references('id')
                ->on('courses');
            $table->foreign('meta_course_id')
                ->references('id')
                ->on('meta_courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_meta_course');
        Schema::dropIfExists('meta_courses');
    }
}
