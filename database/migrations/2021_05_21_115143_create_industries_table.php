<?php

use App\Models\Industry;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndustriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
        });
        Industry::upsert([
            ['name'=>'Automotive', 'description'=>'Automotive'],
            ['name'=>'Banking financial Services and Insurance','description'=>'Banking financial Services and Insurance'],
            ['name'=>'NGO','description'=>'NGO'],
            ['name'=>'Aerospace', 'description'=>'Aerospace'],
            ['name'=>'Logistics','description'=>'Logistics'],
            ['name'=>'Transport', 'description'=>'Transport'],
            ['name'=>'Computer', 'description'=>'Computer'],
            ['name'=>'Public Sector/Government','description'=>'Public Sector/Government'],
            ['name'=>'Telecommunication', 'description'=>'Telecommunication'],
            ['name'=>'Agriculture', 'description'=>'Agriculture'],
            ['name'=>'Construction', 'description'=>'Construction'],
            ['name'=>'Education', 'description'=>'Education'],
            ['name'=>'Pharmaceutical', 'description'=>'Pharmaceutical'],
            ['name'=>'Food', 'description'=>'Food'],
            ['name'=>'Emerging Markets','description'=>'Emerging Markets'],
            ['name'=>'Health Care', 'description'=>'Health care'],
            ['name'=>'Hospitality', 'description'=>'Hospitality'],
            ['name'=>'Research & Media', 'description'=>'Research & Media'],
            ['name'=>'Entertainment', 'description'=>'Entertainment'],
            ['name'=>'News Media', 'description'=>'News Media'],
            ['name'=>'Energy', 'description'=>'Energy'],
            ['name'=>'Manufacturing', 'description'=>'Manufacturing'],
            ['name'=>'Music', 'description'=>'Music'],
            ['name'=>'Mining', 'description'=>'Mining'],
            ['name'=>'Legal Services','description'=>'Legal Services'],
            ['name'=>'Worldwide web', 'description'=>'Worldwide web'],
            ['name'=>'Electronics', 'description'=>'Electronics'],
            ['name'=>'Financials', 'description'=>'Financials'],
            ['name'=>'Transport','description'=>'Transport'],
            ['name'=>'IT', 'description'=>'IT'],
            ['name'=>'E-Commerce', 'description'=>'E-Commerce'],
            ['name'=>'Travel & Tourism','description'=>'Travel & Tourism'],
            ['name'=>'Internet Service Provider','description'=>'Internet Service provider']
        ],['name'],['description']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('industries');
    }
}
