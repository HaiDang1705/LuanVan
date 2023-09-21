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
        Schema::create('lv_customer_infor', function (Blueprint $table) {
            $table->increments('customer_infor_id');
            $table->string('customer_infor_phone');
            $table->string('customer_infor_address');
            $table->integer('customer_infor_user_id')->unsigned();
            $table->foreign('customer_infor_user_id')
                ->references('id')
                ->on('lv_users')
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
        Schema::dropIfExists('lv_customer_infor');
    }
};
