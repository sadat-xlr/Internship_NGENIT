<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('home_one');
            $table->string('home_one_link');
            $table->string('home_two');
            $table->string('home_two_link');
            $table->string('home_three');
            $table->string('home_three_link');
            $table->string('header_one');
            $table->string('header_one_link');
            $table->string('header_two');
            $table->string('header_two_link');
            $table->string('header_three');
            $table->string('header_three_link');
            $table->string('banner_category_page');
            $table->string('banner_link_category_page');
            $table->string('banner_brand_page')->nullable();
            $table->string('banner_link_brand_page')->nullable();
            $table->string('banner_brand_single_page')->nullable();
            $table->string('banner_link_brand_single_page')->nullable();
            $table->string('banner_product_page')->nullable();
            $table->string('banner_link_product_page')->nullable();
            $table->string('banner_searched_product_page')->nullable();
            $table->string('banner_link_searched_product_page')->nullable();
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
        Schema::dropIfExists('banners');
    }
}
