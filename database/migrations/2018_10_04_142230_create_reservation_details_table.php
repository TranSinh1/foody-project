<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->string('email');
            $table->text('note');
            $table->date('day');
            $table->string('hours');
            $table->integer('number_of_adult')->length(3);
            $table->integer('number_of_children')->length(3);
            $table->unsignedInteger('confirm_type_id');
            $table->unsignedInteger('organisation_id');
            $table->foreign('confirm_type_id')->references('id')->on('confirm_types');
            $table->foreign('organisation_id')->references('id')->on('organisation_children')->onDelete('CASCADE');
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
        Schema::dropIfExists('reservation_details');
    }
}
