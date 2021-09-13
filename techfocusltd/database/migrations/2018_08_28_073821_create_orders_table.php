<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
			$table->tinyInteger('status')->nullable()->default('0');
			$table->unsignedInteger('customer_id');
			$table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
			$table->unsignedInteger('payment_id');
			$table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
			$table->unsignedInteger('shipping_id')->nullable();
			$table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('cascade');
            $table->unsignedInteger('discount_id')->nullable();
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
