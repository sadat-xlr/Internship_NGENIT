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
			$table->mediumText('shortDescription');
			$table->longText('description');
            $table->longText('specification')->nullable();
			$table->double('regularPrice', 10, 3)->nullable();
			$table->integer('like')->nullable()->default('0');
            $table->tinyInteger('type');
            $table->string('slug');
            $table->tinyInteger('availability');

            $table->tinyInteger('paymentOption');

			$table->double('discount', 10, 3)->nullable();
            $table->tinyInteger('occasion')->nullable()->default('0');
            $table->tinyInteger('promotion')->nullable()->default('0');
            $table->tinyInteger('clearance')->nullable()->default('0');
            $table->tinyInteger('buy_get')->nullable()->default('0');

            $table->string('measurement')->nullable();
            $table->integer('min_order_qty')->default('1');
            $table->string('delivery_time')->defult('21');
            $table->string('delivery_from')->nullable();

			$table->unsignedInteger('category_id');
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');			
            
            $table->unsignedInteger('subcategory_id');
			$table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            
            $table->unsignedInteger('minicategory_id');
            $table->foreign('minicategory_id')->references('id')->on('minicategories')->onDelete('cascade');

            $table->unsignedInteger('tab_id');
            $table->foreign('tab_id')->references('id')->on('tabs')->onDelete('cascade');
            
            $table->unsignedInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->unsignedInteger('deal_id')->nullable();
            $table->foreign('deal_id')->references('id')->on('deals')->onDelete('cascade');
            
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

