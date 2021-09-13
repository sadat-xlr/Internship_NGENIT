<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncentivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incentives', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sales_value');
            $table->unsignedInteger('incentive_value');
            $table->boolean('is_paid');
            $table->unsignedInteger('salesman_id');
            $table->foreign('salesman_id')->references('id')->on('salesmen')->onDelete('cascade');
            $table->unsignedInteger('mydeal_id');
            $table->foreign('mydeal_id')->references('id')->on('mydeals')->onDelete('cascade');
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
        Schema::dropIfExists('incentives');
    }
}
