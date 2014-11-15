<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('addresses', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
	        $table->decimal('lat', 10, 8);
	        $table->decimal('lng', 11, 8);
	        $table->string('street_address');
	        $table->string('city');
	        $table->string('state');
	        $table->string('country');
	        $table->integer('zip');
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
		Schema::drop('addresses');
	}

}
