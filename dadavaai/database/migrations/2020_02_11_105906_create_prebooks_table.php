<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrebooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prebooks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('launching_date')->nullable();
            $table->longText('details')->nullable();
            $table->string('prebook_discount')->nullable();
            $table->integer('number_of_prebook')->nullable()->default('0');

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
        Schema::dropIfExists('prebooks');
    }
}
