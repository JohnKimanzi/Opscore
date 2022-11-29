<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            //personal details
            $table->id();
            $table->string('sap')->nullable()->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('dob');
            $table->foreignId('gender_id')
                ->nullable()
                ->constrained('genders')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('marital_status_id')
                ->nullable()
                ->constrained('marital_statuses')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('country_id')
                ->nullable()
                ->constrained('countries')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currencies')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            //contacts
            $table->string('phone1')->unique()->nullable();
            $table->string('phone2')->unique()->nullable();
            $table->string('work_email')->unique()->nullable();
            $table->string('personal_email')->unique()->nullable();
            $table->string('residence')->nullable();
            $table->string('permanent_address')->nullable();

            //employment details
            $table->double('basic_salary')->nullable();
            $table->foreignId('contract_id')->nullable()->constrained('contracts')->onDelete('cascade')->onUpdate('cascade');
            $table->date('contract_start')->nullable();
            $table->date('contract_expiry')->nullable();
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('designation_id')->nullable()->constrained('designations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('team_id')->nullable()->onDelete('cascade')->onUpdate('cascade')->constrained('teams');
            // $table->boolean('is_team_lead')->default(false);

            // statutory details
            $table->string('national_id')->unique();
            $table->string('passport_number')->unique();
            $table->string('huduma_number')->unique();
            $table->string('kra_pin')->unique()->nullable();
            $table->string('nssf')->unique()->nullable();
            $table->string('nhif')->unique()->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch_code')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();

            //health details
            //medical conditions on separate table
            $table->foreignId('blood_group_id')->nullable()->constrained('blood_groups')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('disability')->nullable()->constrained('disability_statuses')->onDelete('cascade')->onUpdate('cascade');
            $table->string('disability_details')->nullable();
            $table->foreignId('health')->nullable()->constrained('health_statuses')->onDelete('cascade')->onUpdate('cascade');
            $table->string('health_details')->nullable();

            $table->foreignId('employee_status_id')->nullable()->default(true)->constrained('employee_statuses')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
            $table->timestamp('blocked_at')->nullable();
            $table->softDeletes();

            //reason to disable employee
            $table->string('attri_type');
            $table->string('attri_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
