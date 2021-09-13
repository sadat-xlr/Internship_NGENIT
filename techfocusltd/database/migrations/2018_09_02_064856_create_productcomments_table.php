<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductcommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productcomments', function (Blueprint $table) {
            $table->increments('id');
			$table->string('UserName');
            $table->string('email');
            $table->longText('comment');
            $table->tinyInteger('productReview');
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
        Schema::dropIfExists('productcomments');
    }
}
