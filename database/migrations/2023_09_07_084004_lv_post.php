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
        Schema::create('lv_post', function (Blueprint $table) {
            $table->increments('post_id');
            $table->string('post_name');
            $table->integer('post_status');
            $table->string('post_slug');
            $table->string('post_nguoidang');
            $table->text('post_mota');
            $table->string('post_image');
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
        Schema::dropIfExists('lv_post');
    }
};
