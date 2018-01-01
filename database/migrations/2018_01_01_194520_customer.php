<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Customer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->enum('type', ['有宝宝', '没宝宝'])->nullable();
            $table->unsignedTinyInteger('age', 0);
            $table->string('name_baby', 100);
            $table->unsignedTinyInteger('age_baby', 0);
            $table->string('tel', 20);
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
        Schema::dropIfExists('customer');
    }
}
