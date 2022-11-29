<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            // $table->string('sap')->nullable();
            // $table->date('contract_start')->nullable();
            // $table->integer('tenure')->nullable();
            // $table->foreignId('project__id')->constrained('projects');
            // $table->foreignId('designation_id')->constrained('designations');
            // $table->foreignId('project_type_id')->constrained('project_types');
            // $table->foreignId('leave_balance_id')->constrained('leave_balances');
            $table->foreignId('employee_id')->constrained('employees');
            $table->json('leave_days');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->smallInteger('num_days');
            $table->text('reason')->nullable();
            $table->foreignId('leave_category_id')->constrained('leave_categories');
            $table->string('status')->default('New');
            $table->foreignId('approved_by_id')->nullable()->constrained('users');
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('leaves');
    }
}
