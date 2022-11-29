<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\AppraisalSectionC;
class CreateAppraisalSectionCSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisal_section_c_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->foreign('designation_id')
                ->references('id')
                ->on('designations')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('name');
            $table->text('description');
            $table->integer('weightage');
            $table->timestamps();
        });

        AppraisalSectionC::upsert([
            ['designation_id'=>1,
                'name'=>'Embracing change',
                'description'=>'Effectively cascades change messages to the team; open to different ideas and cultures and responds positively to change',
                'weightage'=>25],


            ['designation_id'=>1,
                'name'=>'Building Trusted Relationships',
                'description'=>'Building and sustaining effective relationships and networks with people to help us deliver results',
                'weightage'=>25],

            ['designation_id'=>1,
                'name'=>'Managing customers and teams',
                'description'=>'Building, motivating and sustaining an effective team to help deliver business results to customers',
                'weightage'=>25],


            ['designation_id'=>1,
                'name'=>'Thinking strategically',
                'description'=>'Understanding the broad business context and wider community and TBL’s role within it',
                'weightage'=>25],


            ['designation_id'=>24,
                'name'=>'Embracing change',
                'description'=>'Effectively cascades change messages to the team; open to different ideas and cultures and responds positively to change',
                'weightage'=>25],


            ['designation_id'=>24,
                'name'=>'Building Trusted Relationships',
                'description'=>'Building and sustaining effective relationships and networks with people to help us deliver results',
                'weightage'=>25],

            ['designation_id'=>24,
                'name'=>'Managing customers and teams',
                'description'=>'Building, motivating and sustaining an effective team to help deliver business results to customers',
                'weightage'=>25],


            ['designation_id'=>24,
                'name'=>'Thinking strategically',
                'description'=>'Understanding the broad business context and wider community and TBL’s role within it',
                'weightage'=>25],

            ['designation_id'=>4,
                'name'=>'Embracing change',
                'description'=>'Effectively cascades change messages to the team; open to different ideas and cultures and responds positively to change',
                'weightage'=>25],


            ['designation_id'=>4,
                'name'=>'Building Trusted Relationships',
                'description'=>'Building and sustaining effective relationships and networks with people to help us deliver results',
                'weightage'=>25],

            ['designation_id'=>4,
                'name'=>'Managing customers and teams',
                'description'=>'Building, motivating and sustaining an effective team to help deliver business results to customers',
                'weightage'=>25],


            ['designation_id'=>4,
                'name'=>'Thinking strategically',
                'description'=>'Understanding the broad business context and wider community and TBL’s role within it',
                'weightage'=>25],

            ['designation_id'=>11,
                'name'=>'Embracing change',
                'description'=>'Effectively cascades change messages to the team; open to different ideas and cultures and responds positively to change',
                'weightage'=>25],


            ['designation_id'=>11,
                'name'=>'Building Trusted Relationships',
                'description'=>'Building and sustaining effective relationships and networks with people to help us deliver results',
                'weightage'=>25],

            ['designation_id'=>11,
                'name'=>'Managing customers and teams',
                'description'=>'Building, motivating and sustaining an effective team to help deliver business results to customers',
                'weightage'=>25],


            ['designation_id'=>11,
                'name'=>'Thinking strategically',
                'description'=>'Understanding the broad business context and wider community and TBL’s role within it',
                'weightage'=>25],
            ['designation_id'=>12,
                'name'=>'Embracing change',
                'description'=>'Effectively cascades change messages to the team; open to different ideas and cultures and responds positively to change',
                'weightage'=>25],


            ['designation_id'=>12,
                'name'=>'Building Trusted Relationships',
                'description'=>'Building and sustaining effective relationships and networks with people to help us deliver results',
                'weightage'=>25],

            ['designation_id'=>12,
                'name'=>'Managing customers and teams',
                'description'=>'Building, motivating and sustaining an effective team to help deliver business results to customers',
                'weightage'=>25],


            ['designation_id'=>12,
                'name'=>'Thinking strategically',
                'description'=>'Understanding the broad business context and wider community and TBL’s role within it',
                'weightage'=>25],

            ['designation_id'=>14,
                'name'=>'Embracing change',
                'description'=>'Effectively cascades change messages to the team; open to different ideas and cultures and responds positively to change',
                'weightage'=>25],


            ['designation_id'=>14,
                'name'=>'Building Trusted Relationships',
                'description'=>'Building and sustaining effective relationships and networks with people to help us deliver results',
                'weightage'=>25],

            ['designation_id'=>14,
                'name'=>'Managing customers and teams',
                'description'=>'Building, motivating and sustaining an effective team to help deliver business results to customers',
                'weightage'=>25],


            ['designation_id'=>14,
                'name'=>'Thinking strategically',
                'description'=>'Understanding the broad business context and wider community and TBL’s role within it',
                'weightage'=>25],

            ['designation_id'=>10,
                'name'=>'Embracing change',
                'description'=>'Effectively cascades change messages to the team; open to different ideas and cultures and responds positively to change',
                'weightage'=>25],


            ['designation_id'=>10,
                'name'=>'Building Trusted Relationships',
                'description'=>'Building and sustaining effective relationships and networks with people to help us deliver results',
                'weightage'=>25],

            ['designation_id'=>10,
                'name'=>'Managing customers and teams',
                'description'=>'Building, motivating and sustaining an effective team to help deliver business results to customers',
                'weightage'=>25],


            ['designation_id'=>10,
                'name'=>'Thinking strategically',
                'description'=>'Understanding the broad business context and wider community and TBL’s role within it',
                'weightage'=>25],

            ['designation_id'=>13,
                'name'=>'Embracing change',
                'description'=>'Effectively cascades change messages to the team; open to different ideas and cultures and responds positively to change',
                'weightage'=>25],


            ['designation_id'=>13,
                'name'=>'Building Trusted Relationships',
                'description'=>'Building and sustaining effective relationships and networks with people to help us deliver results',
                'weightage'=>25],

            ['designation_id'=>13,
                'name'=>'Managing customers and teams',
                'description'=>'Building, motivating and sustaining an effective team to help deliver business results to customers',
                'weightage'=>25],


            ['designation_id'=>13,
                'name'=>'Thinking strategically',
                'description'=>'Understanding the broad business context and wider community and TBL’s role within it',
                'weightage'=>25],

        ],['designation_id'],['name'],['description', 'weightage']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appraisal_section_c_s');
    }
}
