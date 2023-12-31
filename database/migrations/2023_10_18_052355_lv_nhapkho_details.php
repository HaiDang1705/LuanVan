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
        Schema::create('lv_nhapkho_details', function (Blueprint $table) {
            $table->increments('id'); // Sử dụng id làm trường khoá tự tăng
            $table->integer('nhapkho_id')->unsigned();
            $table->foreign('nhapkho_id')
                ->references('nhapkho_id')
                ->on('lv_nhapkho')
                ->onDelete('cascade');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')
                ->references('product_id')
                ->on('lv_product')
                ->onDelete('cascade');
            $table->integer('quantity');
            $table->string('image');
            $table->integer('price');
            $table->integer('product_brand');
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
        Schema::dropIfExists('lv_nhapkho_details');
    }
};
