<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company');
            $table->string('status');
            $table->string('area');
            $table->string('address');
            $table->string('phone');
            $table->string('cell');
            $table->string('cell_office');
            $table->string('email');
            $table->string('email_office');
            $table->string('web');
            $table->string('comments');
            $table->unsignedInteger('promotional_reward_points')->nullable()->default('0');
            $table->unsignedInteger('membership_type_id');
            $table->foreign('membership_type_id')->references('id')->on('membership_types')->onDelete('cascade');
            $table->unsignedInteger('salesman_id');
            $table->foreign('salesman_id')->references('id')->on('salesmen')->onDelete('cascade');
            $table->unsignedInteger('subsector_id');
            $table->foreign('subsector_id')->references('id')->on('subsectors')->onDelete('cascade');
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
        Schema::dropIfExists('clients');
    }
}
