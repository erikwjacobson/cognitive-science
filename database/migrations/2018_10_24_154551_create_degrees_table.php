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
            $table->float('degree_credits')->nullable();
            $table->float('major_credits')->nullable();
            $table->float('prereq_credits')->nullable();
            $table->float('elective_credits')->nullable();
            $table->float('gened_credits')->nullable();
            $table->integer('university_id')->unsigned();
            $table->timestamps();

            $table->foreign('university_id')
                ->references('id')
                ->on('universities');
        });

        Schema::create('degree_department', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('degree_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->string('department_type');

            $table->foreign('degree_id')
                ->references('id')
                ->on('degrees');
            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
        });

        Schema::create('degree_degree_type', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('degree_id')->unsigned();
            $table->integer('degree_type_id')->unsigned();

            $table->foreign('degree_id')
                ->references('id')
                ->on('degrees');
            $table->foreign('degree_type_id')
                ->references('id')
                ->on('degree_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('degree_degree_type');
        Schema::dropIfExists('degree_department');
        Schema::dropIfExists('degrees');
    }
}
