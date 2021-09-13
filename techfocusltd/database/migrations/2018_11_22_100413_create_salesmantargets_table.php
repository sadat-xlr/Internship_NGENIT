<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesmantargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesmantargets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sales_target');
            $table->unsignedInteger('new_client_target');
            $table->unsignedInteger('existing_client_target');
            $table->string('quarter');
            $table->string('month');
            $table->string('year');
            $table->unsignedInteger('physical_mkt');
            $table->unsignedInteger('phone_mkt');
            $table->unsignedInteger('social_mkt');
            $table->unsignedInteger('email_mkt');
            $table->unsignedInteger('salesman_id');
            $table->foreign('salesman_id')->references('id')->on('salesmen')->onDelete('cascade'); 
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
        Schema::dropIfExists('salesmantargets');
    }
}
