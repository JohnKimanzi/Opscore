<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique()->nullable();
            $table->string('name');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('billing_type_id')->nullable();
            $table->foreign('billing_type_id')
                ->references('id')
                ->on('billing_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('billing_frequency_id')->nullable();
            $table->foreign('billing_frequency_id')
                ->references('id')
                ->on('billing_frequencies')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')
                ->references('id')
                ->on('currencies')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->unsignedBigInteger('service_type_id')->nullable();
            $table->foreign('service_type_id')
                ->references('id')
                ->on('service_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('delivery_type_id')->nullable();
            $table->foreign('delivery_type_id')
                ->references('id')
                ->on('delivery_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->double('pricing')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedBigInteger('status_id')->nullable()->default(1);
            $table->foreign('status_id')
                ->references('id')
                ->on('statuses')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('project_type_id')
                ->nullable()
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->constrained('project_types');
            $table->unique('name', 'client_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
