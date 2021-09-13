<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siteinfos', function (Blueprint $table) {
            $table->increments('id');
			$table->string('title');
			$table->string('facebook');
			$table->string('twitter');
			$table->string('instagram');
			$table->string('pinterest');
			$table->string('googleplus');
			$table->string('dribbble');
			$table->string('copyright');
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
        Schema::dropIfExists('siteinfos');
    }
}
