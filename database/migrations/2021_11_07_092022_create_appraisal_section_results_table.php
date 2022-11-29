<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppraisalSectionResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisal_section_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('appraisal_id');
            $table->foreign('appraisal_id')
                ->references('id')
                ->on('appraisals')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->morphs('resultable');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('appraiser_id')->nullable();
            $table->foreign('appraiser_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->double('target_performance')->nullable();
            $table->double('actual_performance')->nullable();
            $table->integer('employee_rating')->nullable();
            $table->text('employee_remarks')->nullable();
            $table->integer('appraiser_rating')->nullable();
            $table->text('appraiser_remarks')->nullable();
            $table->integer('overall_rating');
            $table->boolean('acknowledgment')->default(false);
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
        Schema::dropIfExists('appraisal_section_results');
    }
}
