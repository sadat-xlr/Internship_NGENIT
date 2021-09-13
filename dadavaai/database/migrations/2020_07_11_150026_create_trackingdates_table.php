<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackingdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackingdates', function (Blueprint $table) {
            $table->increments('id');
            $table->date('step_1')->nullable();
            $table->date('step_2')->nullable();
            $table->date('step_3')->nullable();
            $table->date('step_4')->nullable();
            $table->date('step_5')->nullable();
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
        Schema::dropIfExists('trackingdates');
    }
}
