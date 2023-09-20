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
        Schema::create('lv_xa', function (Blueprint $table) {
            $table->increments('xa_id');
            $table->string('xa_name');
            // Thương hiệu
            $table->integer('xa_huyen')->unsigned();
            // Danh muc cate_id la khoa ngoai
            $table->foreign('xa_huyen')
                ->references('huyen_id')
                ->on('lv_huyen')
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
        Schema::dropIfExists('lv_xa');
    }
};
