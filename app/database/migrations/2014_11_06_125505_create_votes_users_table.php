<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVotesUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vote_user', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
	        $table->increments('id');
	        $table->integer('user_id');
	        $table->integer('vote_id');
	        $table->integer('item_id');
			//$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vote_user');
	}

}
