<?php

use App\Models\Department;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->string('code')->unique();
            $table->string('name')->unique();
            $table->string('head_id')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        Department::upsert([
            ['name'=>'Software Development'],
            ['name'=>'Operations'],
            ['name'=>'Information Technology'],
            ['name'=>'Human Resource'],
            ['name'=>'Business Development'],
            ['name'=>'Administration'],

        ],['name'],['description']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
