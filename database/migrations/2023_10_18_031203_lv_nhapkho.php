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
        Schema::create('lv_nhapkho', function (Blueprint $table) {
            // Mã đơn nhập hàng
            $table->increments('nhapkho_id');
            // Tên người nhập
            $table->string('nhapkho_name');
            // Nội dung nhập
            $table->string('nhapkho_description');
            // Tổng tiền đơn nhập hàng
            $table->string('nhapkho_total');
            // Ngày tạo
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
        Schema::dropIfExists('lv_nhapkho');
    }
};
