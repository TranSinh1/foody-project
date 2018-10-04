<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('shipment_type_id');
            $table->unsignedInteger('shipment_status_id');
            $table->string('shipping_address');
            $table->string('phone_user');
            $table->integer('amount');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('shipment_type_id')->references('id')->on('shipment_types');
            $table->foreign('shipment_status_id')->references('id')->on('shipment_statuses');
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
        Schema::dropIfExists('shipments');
    }
}
