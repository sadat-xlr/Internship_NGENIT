<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {

            $table->increments('id');
            $table->string('serviceName');
            $table->string('sku');
			$table->mediumText('shortDescription');
			$table->longText('description');
            $table->longText('specification')->nullable();
			$table->double('regularPrice', 10, 3)->nullable();
			$table->integer('like')->nullable()->default('0');
            $table->string('slug');
            $table->tinyInteger('availability');
			$table->double('discount', 10, 3)->nullable();
            $table->string('unit')->nullable();
            $table->integer('min_order_qty')->default('1');
            $table->string('service_area')->nullable();
            $table->tinyInteger('published')->defult(false);
            $table->string('image');

			$table->unsignedInteger('category_id');
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');			
            
            $table->unsignedInteger('subcategory_id');
			$table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            
            $table->unsignedInteger('minicategory_id');
            $table->foreign('minicategory_id')->references('id')->on('minicategories')->onDelete('cascade');

            $table->unsignedInteger('tab_id')->nullable();
            $table->foreign('tab_id')->references('id')->on('tabs')->onDelete('cascade');

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
        Schema::dropIfExists('services');
    }
}
