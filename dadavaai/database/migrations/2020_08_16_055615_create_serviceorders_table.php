<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serviceorders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->float('hour');
            $table->datetime('schedule')->nullable();
			$table->unsignedInteger('service_id');
			$table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
			$table->unsignedInteger('order_id');
			$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
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
        Schema::dropIfExists('serviceorders');
    }
}
