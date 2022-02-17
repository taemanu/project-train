<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pd_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('stock_amount');
            $table->boolean('status_status');
            $table->timestamps();


            $table->foreign('pd_id')->references('id')->cascadeOnDelete()->on('products');
            $table->foreign('user_id')->references('id')->cascadeOnDelete()->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
