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
        Schema::create('lv_product_quantities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            // Danh muc cate_id la khoa ngoai
            $table->foreign('product_id')
                ->references('product_id')
                ->on('lv_product')
                ->onDelete('cascade');
            $table->integer('product_quantity');
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
        Schema::dropIfExists('lv_product_quantities');
    }
};
