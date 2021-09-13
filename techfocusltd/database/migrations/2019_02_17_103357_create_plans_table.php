<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('month');
            $table->unsignedInteger('year');
            $table->date('date');
            $table->string('marketingType');
            $table->string('status');
            $table->string('product');
            $table->string('solution')->nullable();
            $table->longText('details')->nullable();
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->unsignedInteger('minicategory_id');
            $table->foreign('minicategory_id')->references('id')->on('minicategories')->onDelete('cascade');
            $table->unsignedInteger('salesman_id');
            $table->foreign('salesman_id')->references('id')->on('salesmen')->onDelete('cascade');
            $table->longText('comments');
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
        Schema::dropIfExists('plans');
    }
}
