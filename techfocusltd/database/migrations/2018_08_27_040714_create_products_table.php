<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
			$table->string('productName');
			$table->string('sku');
			$table->longText('description');
			$table->double('price', 10, 3)->nullable();
			$table->double('regularPrice', 10, 3)->nullable();
			$table->integer('view')->nullable()->default('0');
			$table->tinyInteger('type');
			$table->tinyInteger('availablity');
			$table->longText('specification')->nullable();
			$table->unsignedInteger('category_id');
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');			
			$table->unsignedInteger('subcategory_id');
			$table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
			$table->unsignedInteger('minicategory_id');
			$table->foreign('minicategory_id')->references('id')->on('minicategories')->onDelete('cascade');
			$table->unsignedInteger('brand_id');
			$table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
			$table->unsignedInteger('industry_id');
			$table->foreign('industry_id')->references('id')->on('industries')->onDelete('cascade');
			$table->unsignedInteger('technology_id');
			$table->foreign('technology_id')->references('id')->on('technologies')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
