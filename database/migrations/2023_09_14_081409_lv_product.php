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
        Schema::create('lv_product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('product_name');
            $table->string('product_slug');
            $table->integer('product_price');
            $table->string('product_image');
            $table->text('product_mota');
            $table->integer('product_status');
            $table->integer('product_cate')->unsigned();
            // Danh muc cate_id la khoa ngoai
            $table->foreign('product_cate')
                ->references('cate_id')
                ->on('lv_category')
                ->onDelete('cascade');
            // onDelete('cascade') => xoa danh muc => tat ca san pham trong danh muc deu bi xoa => toan ven du lieu
            $table->integer('product_type')->unsigned();
            // Danh muc type_id la khoa ngoai
            $table->foreign('product_type')
                ->references('type_id')
                ->on('lv_typeproduct')
                ->onDelete('cascade');
            // onDelete('cascade') => xoa loai san pham => tat ca san pham trong loai san pham deu bi xoa => toan ven du lieu
            $table->integer('product_color')->unsigned();
            // Danh muc color_id la khoa ngoai
            $table->foreign('product_color')
                ->references('color_id')
                ->on('lv_colorproduct')
                ->onDelete('cascade');
            // onDelete('cascade') => xoa loai san pham => tat ca san pham trong loai san pham deu bi xoa => toan ven du lieu
            // Thương hiệu
            $table->integer('product_brand')->unsigned();
            // Danh muc cate_id la khoa ngoai
            $table->foreign('product_brand')
                ->references('brand_id')
                ->on('lv_brand')
                ->onDelete('cascade');
            // onDelete('cascade') => xoa danh muc => tat ca san pham trong danh muc deu bi xoa => toan ven du lieu
            // 
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
        Schema::dropIfExists('lv_product');
    }
};
