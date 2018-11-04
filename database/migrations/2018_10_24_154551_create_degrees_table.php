<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDegreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('degrees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('minor')->nullable();
            $table->string('concentration')->nullable();
            $table->integer('degree_credits')->nullable();
            $table->integer('major_credits')->nullable();
            $table->integer('prereq_credits')->nullable();
            $table->integer('elective_credits')->nullable();
            $table->integer('gened_credits')->nullable();
            $table->integer('university_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->timestamps();

            $table->foreign('university_id')
                ->references('id')
                ->on('universities');
            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('degrees');
    }
}
