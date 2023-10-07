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
        Schema::create('lv_cart', function (Blueprint $table) {
            $table->increments('id'); // Sử dụng id làm trường khoá tự tăng
            // Lấy id khách hàng đặt hàng
            $table->integer('id_customer')->unsigned();
            $table->foreign('id_customer')
                ->references('id')
                ->on('lv_customers')
                ->onDelete('cascade');
            // Lấy id sản phẩm được đặt
            $table->integer('id_product')->unsigned();
            $table->foreign('id_product')
                ->references('product_id')
                ->on('lv_product')
                ->onDelete('cascade');
            $table->integer('quantity');
            $table->string('image');
            $table->integer('price');
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
        Schema::dropIfExists('lv_cart');
    }
};
