<?php

use App\Models\AppraisalSectionB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppraisalSectionBTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisal_section_b', function (Blueprint $table) {
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

        AppraisalSectionB::upsert([
            [
                'designation_id'=>1,
                'name'=>'Delivering Outstanding Customer Service',
            'description'=>'Putting the employee at the centre of everything we do and delivering an excellent, timely and personalised service,focus on employee needs while balancing business needs.  Willing to extend beyond normal business hours to complete assignments and meet deadlines',
            'weightage'=>25],


            [
                'designation_id'=>1,
                'name'=>'Cost Control & Minimisation',
            'description'=>'Effective use of resources to ensure minimal wastage and cost,working within the allocated budget,error reduction,',
            'weightage'=>25],

            ['designation_id'=>1,
                'name'=>'Working Collaboratively',
                'description'=>'inclusively with others, regardless of background, to create and deliver a shared agenda.Collaborative Working, internal & external stakeholders, manage conflict, seeks & gives feedback) ',
                'weightage'=>25],


            ['designation_id'=>1,
                'name'=>'Planning Efficiently',
            'description'=>'Working out what needs to be done and planning for delivery in the most efficient way.  Meeting/office absenteeism.  Avoids pushing agreed timelines more than once.  Is not reminded more than once on a deliverable',
            'weightage'=>25],

            [
                'designation_id'=>24,
                'name'=>'Delivering Outstanding Customer Service',
                'description'=>'Putting the employee at the centre of everything we do and delivering an excellent, timely and personalised service,focus on employee needs while balancing business needs.  Willing to extend beyond normal business hours to complete assignments and meet deadlines',
                'weightage'=>25],


            [
                'designation_id'=>24,
                'name'=>'Cost Control & Minimisation',
                'description'=>'Effective use of resources to ensure minimal wastage and cost,working within the allocated budget,error reduction,',
                'weightage'=>25],

            ['designation_id'=>24,
                'name'=>'Working Collaboratively',
                'description'=>'inclusively with others, regardless of background, to create and deliver a shared agenda.Collaborative Working, internal & external stakeholders, manage conflict, seeks & gives feedback) ',
                'weightage'=>25],


            ['designation_id'=>24,
                'name'=>'Planning Efficiently',
                'description'=>'Working out what needs to be done and planning for delivery in the most efficient way.  Meeting/office absenteeism.  Avoids pushing agreed timelines more than once.  Is not reminded more than once on a deliverable',
                'weightage'=>25],


            [
                'designation_id'=>4,
                'name'=>'Delivering Outstanding Customer Service',
                'description'=>'Putting the employee at the centre of everything we do and delivering an excellent, timely and personalised service,focus on employee needs while balancing business needs.  Willing to extend beyond normal business hours to complete assignments and meet deadlines',
                'weightage'=>25],


            [
                'designation_id'=>4,
                'name'=>'Cost Control & Minimisation',
                'description'=>'Effective use of resources to ensure minimal wastage and cost,working within the allocated budget,error reduction,',
                'weightage'=>25],

            ['designation_id'=>4,
                'name'=>'Working Collaboratively',
                'description'=>'inclusively with others, regardless of background, to create and deliver a shared agenda.Collaborative Working, internal & external stakeholders, manage conflict, seeks & gives feedback) ',
                'weightage'=>25],


            ['designation_id'=>4,
                'name'=>'Planning Efficiently',
                'description'=>'Working out what needs to be done and planning for delivery in the most efficient way.  Meeting/office absenteeism.  Avoids pushing agreed timelines more than once.  Is not reminded more than once on a deliverable',
                'weightage'=>25],


            [
                'designation_id'=>11,
                'name'=>'Delivering Outstanding Customer Service',
                'description'=>'Putting the employee at the centre of everything we do and delivering an excellent, timely and personalised service,focus on employee needs while balancing business needs.  Willing to extend beyond normal business hours to complete assignments and meet deadlines',
                'weightage'=>25],


            [
                'designation_id'=>11,
                'name'=>'Cost Control & Minimisation',
                'description'=>'Effective use of resources to ensure minimal wastage and cost,working within the allocated budget,error reduction,',
                'weightage'=>25],

            ['designation_id'=>11,
                'name'=>'Working Collaboratively',
                'description'=>'inclusively with others, regardless of background, to create and deliver a shared agenda.Collaborative Working, internal & external stakeholders, manage conflict, seeks & gives feedback) ',
                'weightage'=>25],


            ['designation_id'=>11,
                'name'=>'Planning Efficiently',
                'description'=>'Working out what needs to be done and planning for delivery in the most efficient way.  Meeting/office absenteeism.  Avoids pushing agreed timelines more than once.  Is not reminded more than once on a deliverable',
                'weightage'=>25],

            [
                'designation_id'=>12,
                'name'=>'Delivering Outstanding Customer Service',
                'description'=>'Putting the employee at the centre of everything we do and delivering an excellent, timely and personalised service,focus on employee needs while balancing business needs.  Willing to extend beyond normal business hours to complete assignments and meet deadlines',
                'weightage'=>25],


            [
                'designation_id'=>12,
                'name'=>'Cost Control & Minimisation',
                'description'=>'Effective use of resources to ensure minimal wastage and cost,working within the allocated budget,error reduction,',
                'weightage'=>25],

            ['designation_id'=>12,
                'name'=>'Working Collaboratively',
                'description'=>'inclusively with others, regardless of background, to create and deliver a shared agenda.Collaborative Working, internal & external stakeholders, manage conflict, seeks & gives feedback) ',
                'weightage'=>25],


            ['designation_id'=>12,
                'name'=>'Planning Efficiently',
                'description'=>'Working out what needs to be done and planning for delivery in the most efficient way.  Meeting/office absenteeism.  Avoids pushing agreed timelines more than once.  Is not reminded more than once on a deliverable',
                'weightage'=>25],

            [
                'designation_id'=>14,
                'name'=>'Delivering Outstanding Customer Service',
                'description'=>'Putting the employee at the centre of everything we do and delivering an excellent, timely and personalised service,focus on employee needs while balancing business needs.  Willing to extend beyond normal business hours to complete assignments and meet deadlines',
                'weightage'=>25],


            [
                'designation_id'=>14,
                'name'=>'Cost Control & Minimisation',
                'description'=>'Effective use of resources to ensure minimal wastage and cost,working within the allocated budget,error reduction,',
                'weightage'=>25],

            ['designation_id'=>14,
                'name'=>'Working Collaboratively',
                'description'=>'inclusively with others, regardless of background, to create and deliver a shared agenda.Collaborative Working, internal & external stakeholders, manage conflict, seeks & gives feedback) ',
                'weightage'=>25],


            ['designation_id'=>14,
                'name'=>'Planning Efficiently',
                'description'=>'Working out what needs to be done and planning for delivery in the most efficient way.  Meeting/office absenteeism.  Avoids pushing agreed timelines more than once.  Is not reminded more than once on a deliverable',
                'weightage'=>25],


            [
                'designation_id'=>10,
                'name'=>'Delivering Outstanding Customer Service',
                'description'=>'Putting the employee at the centre of everything we do and delivering an excellent, timely and personalised service,focus on employee needs while balancing business needs.  Willing to extend beyond normal business hours to complete assignments and meet deadlines',
                'weightage'=>25],


            [
                'designation_id'=>10,
                'name'=>'Cost Control & Minimisation',
                'description'=>'Effective use of resources to ensure minimal wastage and cost,working within the allocated budget,error reduction,',
                'weightage'=>25],

            ['designation_id'=>10,
                'name'=>'Working Collaboratively',
                'description'=>'inclusively with others, regardless of background, to create and deliver a shared agenda.Collaborative Working, internal & external stakeholders, manage conflict, seeks & gives feedback) ',
                'weightage'=>25],


            ['designation_id'=>10,
                'name'=>'Planning Efficiently',
                'description'=>'Working out what needs to be done and planning for delivery in the most efficient way.  Meeting/office absenteeism.  Avoids pushing agreed timelines more than once.  Is not reminded more than once on a deliverable',
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
        Schema::dropIfExists('appraisal_section_b');
    }
}
