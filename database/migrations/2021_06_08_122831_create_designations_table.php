<?php

use App\Models\Designation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designations', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->string('code');
            $table->string('name')->unique();
            $table->foreignId('reports_to')->nullable()->constrained('designations', 'id');
            $table->text('description')->nullable();
            $table->foreignid('department_id')
            ->nullable()
            ->constrained('departments')
            ->onDelete('cascade');
            $table->timestamps();
        });
        Designation::upsert([
            ['name'=>'Software Developer', 'description'=>'Software Developer'],
            ['name'=>'Head of Operations', 'description'=>'Head of Operations'],
            ['name'=>'Operations Manager', 'description'=>'Operations Manager'],
            ['name'=>'Assistant Operations Manager', 'description'=>'Assistant Operations Manager'],
            ['name'=>'Team Coordinator', 'description'=>'Team Coordinator'],
            ['name'=>'Group Coordinator', 'description'=>'Group Coordinator'],
            ['name'=>'Quality Lead', 'description'=>'Quality Lead'],
            ['name'=>'Quality Coordinator', 'description'=>'Quality Coordinator'],
            ['name'=>'Workforce Manager', 'description'=>'Workforce Manager'],
            ['name'=>'Management Information Systems Executive', 'description'=>'Management Information Systems Executive'],
            ['name'=>'Senior Management Information Systems Executive', 'description'=>'Senior Management Information Systems Executive'],
            ['name'=>'BPO Director', 'description'=>'Business Process Outsourcing Director'],
            ['name'=>'BPO Executive', 'description'=>'Business Process Outsourcing Executive'],
            ['name'=>'IT Executive', 'description'=>'Information Technology Executive'],
            ['name'=>'Senior Information Technology Executive', 'description'=>'Senior Information Technology Executive'],
            ['name'=>'IT Manager', 'description'=>'Information Technology Manager'],
            ['name'=>'Business Development Manager', 'description'=>'Business Development Manager'],
            ['name'=>'Business Development Executive', 'description'=>'Business Development Executive'],
            ['name'=>'Sales | Presales Executive', 'description'=>'Presales Executive'],
            ['name'=>'Administration Executive', 'description'=>'Administration Executive'],
            ['name'=>'Human Resouce Manager', 'description'=>'Human Resouce Manager'],
            ['name'=>'Human Resouce Executive', 'description'=>'Human Resouce Executive'],
            ['name'=>'Office Assistant', 'description'=>'Office Assistant'],
            ['name'=>'Front Desk Executive', 'description'=>'Front Desk Executive'],
            ['name'=>'Administration Assistant', 'description'=>'Administration Assistant'],
            ['name'=>'Trainer', 'description'=>'Trainer'],

        ],['name'],['description']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('designations');
    }
}
