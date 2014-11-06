<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('votes', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
	        $table->increments('id');
	        $table->integer('item_id')->unsigned();
	        $table->foreign('item_id')->references('id')->on('items');
	        $table->integer('like');
	        $table->integer('dislike');
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
		Schema::drop('votes');
	}

}
