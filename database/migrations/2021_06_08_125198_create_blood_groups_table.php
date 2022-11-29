<?php

use App\Models\BloodGroup;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('rhesus')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
        BloodGroup::upsert([
            ['name'=>'A-', 'rhesus'=>'negative', 'description'=>'A negative'],
            ['name'=>'A+', 'rhesus'=>'positive', 'description'=>'A positive'],
            ['name'=>'B-', 'rhesus'=>'negative', 'description'=>'B negative'],
            ['name'=>'B+', 'rhesus'=>'positive', 'description'=>'B positive'],
            ['name'=>'AB-', 'rhesus'=>'negative', 'description'=>'AB negative'],
            ['name'=>'AB+', 'rhesus'=>'positive', 'description'=>'AB positive'],
            ['name'=>'O-', 'rhesus'=>'negative', 'description'=>'O negative'],
            ['name'=>'O+', 'rhesus'=>'positive', 'description'=>'O positive'],

        ],['name', 'rhesus'],['description']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blood_groups');
    }
}
