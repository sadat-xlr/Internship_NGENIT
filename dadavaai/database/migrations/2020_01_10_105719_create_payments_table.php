<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('paymentOption')->nullable();
            $table->double('amount');
            $table->double('store_amount');
            $table->string('card_type')->nullable();
            $table->string('tran_id')->nullable();
            $table->string('bank_tran_id')->nullable();
            $table->string('card_no')->nullable();
            $table->string('card_issuer')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
