<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientpointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientpoints', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('po_point')->nullable();
            $table->integer('shared_ref_point')->nullable();
            $table->integer('new_friend_purchase_point')->nullable();
            $table->integer('pro_review_ref_point')->nullable();
            $table->integer('redeem')->nullable();
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
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
        Schema::dropIfExists('clientpoints');
    }
}
