<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productsads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ad1Image');
            $table->string('ad2Image');
            $table->string('ad3Image');
            $table->unsignedInteger('ad1Product_id');
            $table->foreign('ad1Product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedInteger('ad2Product_id');
            $table->foreign('ad2Product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedInteger('ad3Product_id');
			$table->foreign('ad3Product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('productsads');
    }
}
