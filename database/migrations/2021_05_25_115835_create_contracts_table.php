<?php

use App\Models\Contract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('type');
            $table->string('description')->nullable();
            $table->timestamps();
        });
        Contract::upsert([
            ['name'=>'Permanent', 'type'=>'Permanent', 'description'=>'Permanent'],
            ['name'=>'Contractual', 'type'=>'Contractual', 'description'=>'Contractual'],
            ['name'=>'Casual', 'type'=>'Casual', 'description'=>'Casual'],
            ['name'=>'Probation', 'type'=>'Probation', 'description'=>'Probation'],
            ['name'=>'On Job Training', 'type'=>'On Job Training', 'description'=>'On Job Training'],
        ],['name', 'type'],['description']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
