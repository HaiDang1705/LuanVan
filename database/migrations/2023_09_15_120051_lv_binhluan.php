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
        Schema::create('lv_binhluan', function (Blueprint $table) {
            $table->increments('bl_id');
            $table->string('bl_name');
            $table->string('bl_content');
            $table->string('bl_email');
            $table->integer('bl_status');
            // Thương hiệu
            $table->integer('bl_product_id')->unsigned();
            // Danh muc cate_id la khoa ngoai
            $table->foreign('bl_product_id')
                ->references('product_id')
                ->on('lv_product')
                ->onDelete('cascade');
            // onDelete('cascade') => xoa danh muc => tat ca san pham trong danh muc deu bi xoa => toan ven du lieu
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
        Schema::dropIfExists('lv_binhluan');
    }
};
