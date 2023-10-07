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
        Schema::create('lv_customers_infor', function (Blueprint $table) {
            $table->increments('customers_infor_id');
            $table->string('address');
            $table->string('phone');
            $table->string('image')->nullable();
            $table->integer('id_customer')->unsigned();
            $table->foreign('id_customer')
                ->references('id')
                ->on('lv_customers')
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
        Schema::dropIfExists('lv_customers_infor');
    }
};
