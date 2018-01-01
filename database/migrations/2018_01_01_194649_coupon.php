<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Coupon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon', function (Blueprint $table) {
            $table->string('name', 100);
            $table->enum('brand', ['Babyspace','GICOpark','GICOfit']);
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->enum('customer_type', ['有宝宝', '没宝宝', '全部']);
            $table->enum('type', ['注册用户','市场']);
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
        Schema::dropIfExists('coupon');
    }
}
