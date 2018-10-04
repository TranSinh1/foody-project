<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisation_children', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('start_hours');
            $table->date('stop_hours');
            $table->unsignedInteger('town_id');
            $table->string('addressDetail');
            $table->unsignedInteger('organisation_parent_id');
            $table->integer('shop_fee');
            $table->text('about_reservation')->nullable();
            $table->foreign('town_id')->references('id')->on('towns')->onDelete('CASCADE');
            $table->foreign('organisation_parent_id')->references('id')->on('organisation_parents')->onDelete('CASCADE');
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
        Schema::dropIfExists('organisation_children');
    }
}
