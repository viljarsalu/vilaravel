<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlanAndPrice extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plans_and_prices', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
	        $table->string('title');
	        $table->string('description');			
	        $table->string('price');			
	        $table->dateTime('date_start');			
	        $table->dateTime('date_end');			
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
		Schema::drop('plans_and_prices');
	}

}
