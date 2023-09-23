<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lv_shipping', function (Blueprint $table) {
            $table->increments('shipping_id');
            $table->string('shipping_email');
            $table->string('shipping_name');
            $table->string('shipping_phone');
            $table->string('shipping_address');
            $table->integer('shipping_slug');
            $table->string('shipping_total');
            // $table->integer('shipping_status');
            $table->integer('shipping_status')->unsigned();
            $table->foreign('shipping_status')
                ->references('status_id')
                ->on('lv_shipping_status')
                ->onDelete('cascade');
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
        Schema::dropIfExists('lv_shipping');
    }
};
