<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOndemandVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ondemand_vendor', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('ondemand_id');
            $table->foreign('ondemand_id')->references('id')->on('ondemands')->onDelete('cascade');  

            $table->unsignedInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');   

            $table->integer('view')->nullable()->default('0');  


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
        Schema::dropIfExists('ondemand_vendor');
    }
}
