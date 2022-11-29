<?php

use App\Models\Office;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('country_id')->constrained('countries', 'id');
            $table->string('town');
            $table->string('description')->nullable();
            $table->timestamps();
        });
        Office::upsert([
            ['name'=>'Kenya Main Office', 'country_id'=>110, 'town'=>'Nairobi'],
        ],['name', 'country_id'], ['town']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offices');
    }
}
