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
            // $table->integer('shipping_user_id')->unsigned();
            // $table->foreign('shipping_user_id')
            //     ->references('id')
            //     ->on('lv_users')
            //     ->onDelete('cascade');
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
