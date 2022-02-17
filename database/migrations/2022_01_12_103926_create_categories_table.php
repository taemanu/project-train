<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('cate_name');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->char('pd_code',150);
            $table->string('pd_name');
            $table->string('pd_image');
            $table->decimal('pd_price', $precision = 8, $scale = 2);
            $table->integer('pd_amount')->nullable();
            $table->smallInteger('pd_minimum')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('cate_id');
            $table->timestamps();

            $table->foreign('cate_id')->references('id')->on('categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
