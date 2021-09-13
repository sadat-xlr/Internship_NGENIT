<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company')->nullable();
			$table->string('customerName')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
			$table->string('division')->nullable();
            $table->string('zipCode')->nullable();
            $table->string('phone')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('email');
            $table->string('office_email')->nullable();
            $table->string('password');
            $table->string('token')->nullable();
            $table->boolean('status')->nullable()->default('0');
            $table->unsignedInteger('promotional_reward_points')->nullable()->default('0');
            $table->unsignedInteger('non_promotional_reward_points')->nullable()->default('0');
            $table->unsignedInteger('membership_type_id');
            $table->foreign('membership_type_id')->references('id')->on('membership_types')->onDelete('cascade');
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
        Schema::dropIfExists('customers');
    }
}
