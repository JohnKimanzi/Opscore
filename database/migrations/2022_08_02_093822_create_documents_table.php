<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->unsignedBigInteger('document_type_id');
            $table->foreign('document_type_id')
                ->references('id')
                ->on('document_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('size');
            $table->string('url')->unique();
            $table->bigInteger('uploaded_by_id');
            $table->string('documentable_type');
            $table->bigInteger('documentable_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
