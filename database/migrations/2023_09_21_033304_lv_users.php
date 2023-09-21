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
        Schema::create('lv_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            // 
            $table->string('name');
            // 
            $table->string( 'password');
            $table->integer('role')->unsigned();
            $table->foreign('role')
                ->references('role_id')
                ->on('lv_roles')
                ->onDelete('cascade');

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
        Schema::dropIfExists('lv_users');
    }
};
