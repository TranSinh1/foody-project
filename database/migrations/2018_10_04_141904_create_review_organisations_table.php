<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewOrganisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_organisations', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->integer('review_space')->length(1);
            $table->integer('review_position')->length(1);
            $table->integer('review_quality')->length(1);
            $table->integer('review_price')->length(1);
            $table->integer('review_service')->length(1);
            $table->unsignedInteger('organisation_id');
            $table->unsignedInteger('user_id');
            $table->foreign('organisation_id')->references('id')->on('organisation_children')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
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
        Schema::dropIfExists('review_organisations');
    }
}
