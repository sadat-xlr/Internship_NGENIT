<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductinformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productinformations', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('description_1')->nullable();
            $table->string('image_1')->nullable();
            $table->longText('description_2')->nullable();
            $table->string('image_2')->nullable();
            $table->longText('description_3')->nullable();
            $table->string('image_3')->nullable();
            $table->longText('description_4')->nullable();
            $table->string('image_4')->nullable();

            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade'); 

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
        Schema::dropIfExists('productinformations');
    }
}
