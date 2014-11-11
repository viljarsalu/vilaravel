<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prices', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
	        $table->string('title');
	        $table->string('description');			
	        $table->decimal('price', 10, 2);			
	        $table->dateTime('date_start');			
	        $table->dateTime('date_end');			
	        $table->boolean('public');		
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
		Schema::drop('prices');
	}

}
