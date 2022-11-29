<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Relation;

class CreateRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->timestamps();
        });

        Relation::upsert([
            ['name'=>'mother'],
            ['name'=>'father'],
            ['name'=>'Co-worker'],
            ['name'=>'Friend'],
            ['name'=>'Wife'],
            ['name'=>'Husband'],
            ['name'=>'Sister'],
            ['name'=>'Brother'],
            ['name'=>'Neighbour'],
            ['name'=>'Other'],
        ],['name'], ['name']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relations');
    }
}
