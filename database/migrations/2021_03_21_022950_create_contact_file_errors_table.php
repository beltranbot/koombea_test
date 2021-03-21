<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactFileErrorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_file_errors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_file_id');
            $table->string('field');
            $table->string('description');
            $table->integer('line');
            $table->text('error_message')->nullable();
            $table->foreign('contact_file_id')->references('id')->on('contact_files');
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
        Schema::dropIfExists('contact_file_errors');
    }
}
