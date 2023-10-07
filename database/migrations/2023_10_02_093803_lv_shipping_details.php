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
        Schema::create('lv_shipping_details', function (Blueprint $table) {
            $table->increments('id'); // Sử dụng id làm trường khoá tự tăng
            // $table->integer('shipping_id')->unsigned();
            $table->integer('shipping_id')->unsigned();
            $table->foreign('shipping_id')
                ->references('shipping_id')
                ->on('lv_shipping')
                ->onDelete('cascade');
            $table->integer('shipping_details_product_id')->unsigned();
            $table->foreign('shipping_details_product_id')
                ->references('product_id')
                ->on('lv_product')
                ->onDelete('cascade');
            $table->integer('quantity');
            $table->string('image');
            $table->decimal('price', 10, 2);
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
        Schema::dropIfExists('lv_shipping_details');
    }
};
