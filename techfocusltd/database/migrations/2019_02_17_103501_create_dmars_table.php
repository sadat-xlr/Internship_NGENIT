<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDmarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->string('area');
            $table->date('date');
            $table->string('clientType');
            $table->string('acitivity');
            $table->string('current_status');
            $table->string('solution')->nullable();
            $table->string('product');
            $table->string('contact');
            $table->string('comment_by_sales');
            $table->string('companyName');
            $table->unsignedInteger('sector_id');
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
            $table->unsignedInteger('minicategory_id');
            $table->foreign('minicategory_id')->references('id')->on('minicategories')->onDelete('cascade');
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
        Schema::dropIfExists('dmars');
    }
}
