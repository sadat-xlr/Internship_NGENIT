<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreorderpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preorderpayments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('preorder_id');
			$table->foreign('preorder_id')->references('id')->on('preorders')->onDelete('cascade');
            $table->unsignedInteger('payment_id');
			$table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade'); 
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
        Schema::dropIfExists('preorderpayments');
    }
}
