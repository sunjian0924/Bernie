<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWishlists extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('wishlists', function($table)
	    {
	        $table->increments('id');
	        $table->string('MUid');
	        $table->string('customer');
	        $table->string('courseID');
	        $table->string('time');
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
		
		Schema::drop('wishlists');
	}
	

}
