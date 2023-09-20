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
        Schema::create('lv_huyen', function (Blueprint $table) {
            $table->increments('huyen_id');
            $table->string('huyen_name');
            // Thương hiệu
            $table->integer('huyen_tinh')->unsigned();
            // Danh muc cate_id la khoa ngoai
            $table->foreign('huyen_tinh')
                ->references('tinh_id')
                ->on('lv_tinh')
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
        Schema::dropIfExists('lv_huyen');
    }
};
