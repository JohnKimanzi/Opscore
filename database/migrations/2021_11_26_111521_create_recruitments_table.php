<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->string('id_number');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('email');
            $table->string('residence');
            $table->string('marital_status');
            $table->unsignedBigInteger('gender');
            $table->foreign('gender')
                ->references('id')
                ->on('genders')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('county');
            $table->date('dob');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('level_of_education');
            $table->string('course');
            $table->string('work_experience');
            $table->string('years_of_experience');
            $table->string('area_of_experience');
            $table->string('employment_status');

            $table->string('job_info');
            $table->float('salary_expectation');
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
        Schema::dropIfExists('recruitments');
    }
}
