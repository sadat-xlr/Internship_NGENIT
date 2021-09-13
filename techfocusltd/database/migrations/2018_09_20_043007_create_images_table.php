<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
			$table->string('image1');
			$table->string('image2')->nullable();
			$table->string('image3')->nullable();
			$table->string('image4')->nullable();
			$table->string('image5')->nullable();
			$table->string('image6')->nullable();
			$table->string('image7')->nullable();
			$table->string('image8')->nullable();
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
        Schema::dropIfExists('images');
    }
}
