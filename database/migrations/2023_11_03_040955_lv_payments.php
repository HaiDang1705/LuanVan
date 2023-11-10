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
        Schema::create('lv_payments', function (Blueprint $table) {
            $table->increments('id'); // Sử dụng id làm trường khoá tự tăng
            $table->integer('p_transaction_id')->nullable();
            $table->integer('p_user_id')->nullable();
            $table->string('p_note')->nullable()->comment('Nội dung thanh toán');
            $table->float('p_money')->nullable()->comment('Số tiền thanh toán');
            $table->string('p_vnp_response_code', 255)->nullable()->comment('Mã phản hồi');
            $table->string('p_code_vnpay', 255)->nullable()->comment('Mã giao dịch VNPAY');
            $table->string('p_code_bank', 255)->nullable()->comment('Mã ngân hàng');
            $table->dateTime('p_time')->nullable()->comment('Thời gian chuyển khoản');
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
        Schema::dropIfExists('lv_payments');
    }
};
