<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMydealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mydeals', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('pqr');
            $table->string('quarter');
            $table->unsignedInteger('pq_value');
            $table->string('current_status');
            $table->string('closing_status');
            $table->string('probability_status');
            $table->string('probability_reason');
            $table->string('comments_by_sales');
            $table->string('comments_by_manager');
            $table->string('final_status');
            $table->string('project_status');
            $table->string('category_solution');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
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
        Schema::dropIfExists('mydeals');
    }
}
